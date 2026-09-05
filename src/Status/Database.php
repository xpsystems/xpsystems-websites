<?php

declare(strict_types=1);

namespace App\Status;

use PDO;
use RuntimeException;

final class Database
{
    public static function connect(array $config): PDO
    {
        $db = $config['db'] ?? [];
        $driver = $db['driver'] ?? 'sqlite';

        if ($driver === 'sqlite') {
            if (!extension_loaded('pdo_sqlite')) {
                throw new RuntimeException("pdo_sqlite extension is not loaded.");
            }
            $path = $db['sqlite_path'] ?? (dirname(__DIR__, 2) . '/data/status/status.db');
            $dir = dirname($path);
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
            $pdo = new PDO('sqlite:' . $path);
            $pdo->exec('PRAGMA journal_mode=WAL');
            $pdo->exec('PRAGMA foreign_keys=ON');
        } elseif ($driver === 'mysql') {
            if (!extension_loaded('pdo_mysql')) {
                throw new RuntimeException("pdo_mysql extension is not loaded.");
            }
            $dsn = sprintf(
                'mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4',
                $db['mysql_host'] ?? '127.0.0.1',
                (int)($db['mysql_port'] ?? 3306),
                $db['mysql_dbname'] ?? 'xpsystems_status'
            );
            $pdo = new PDO($dsn, $db['mysql_user'] ?? 'root', $db['mysql_password'] ?? '', [
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4",
            ]);
        } else {
            throw new RuntimeException("Unsupported database driver: " . $driver);
        }

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        self::migrate($pdo, $driver);

        return $pdo;
    }

    public static function migrate(PDO $pdo, string $driver): void
    {
        if ($driver === 'mysql') {
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS checks (
                    id         INT AUTO_INCREMENT PRIMARY KEY,
                    checked_at INT         NOT NULL,
                    overall    VARCHAR(32) NOT NULL,
                    INDEX idx_checks_ts (checked_at)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS check_results (
                    id         INT AUTO_INCREMENT PRIMARY KEY,
                    check_id   INT          NOT NULL,
                    slug       VARCHAR(128) NOT NULL,
                    status     VARCHAR(32)  NOT NULL,
                    http_code  SMALLINT,
                    latency_ms INT,
                    INDEX idx_cr_slug_check (slug, check_id),
                    CONSTRAINT fk_cr_check FOREIGN KEY (check_id)
                        REFERENCES checks(id) ON DELETE CASCADE
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS daily_stats (
                    id               INT AUTO_INCREMENT PRIMARY KEY,
                    slug             VARCHAR(128) NOT NULL,
                    date             DATE         NOT NULL,
                    total_checks     INT          NOT NULL DEFAULT 0,
                    up_checks        INT          NOT NULL DEFAULT 0,
                    down_checks      INT          NOT NULL DEFAULT 0,
                    degraded_checks  INT          NOT NULL DEFAULT 0,
                    uptime_pct       FLOAT,
                    down_secs        INT          NOT NULL DEFAULT 0,
                    degraded_secs    INT          NOT NULL DEFAULT 0,
                    avg_latency_ms   INT,
                    UNIQUE KEY uq_daily_stats_slug_date (slug, date)
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4
            ");
        } else {
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS checks (
                    id         INTEGER PRIMARY KEY AUTOINCREMENT,
                    checked_at INTEGER NOT NULL,
                    overall    TEXT    NOT NULL
                )
            ");
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS check_results (
                    id         INTEGER PRIMARY KEY AUTOINCREMENT,
                    check_id   INTEGER NOT NULL,
                    slug       TEXT    NOT NULL,
                    status     TEXT    NOT NULL,
                    http_code  INTEGER,
                    latency_ms INTEGER,
                    FOREIGN KEY (check_id) REFERENCES checks(id) ON DELETE CASCADE
                )
            ");
            $pdo->exec("
                CREATE TABLE IF NOT EXISTS daily_stats (
                    id              INTEGER PRIMARY KEY AUTOINCREMENT,
                    slug            TEXT    NOT NULL,
                    date            TEXT    NOT NULL,
                    total_checks    INTEGER NOT NULL DEFAULT 0,
                    up_checks       INTEGER NOT NULL DEFAULT 0,
                    down_checks     INTEGER NOT NULL DEFAULT 0,
                    degraded_checks INTEGER NOT NULL DEFAULT 0,
                    uptime_pct      REAL,
                    down_secs       INTEGER NOT NULL DEFAULT 0,
                    degraded_secs   INTEGER NOT NULL DEFAULT 0,
                    avg_latency_ms  INTEGER,
                    UNIQUE (slug, date)
                )
            ");
            $pdo->exec("CREATE INDEX IF NOT EXISTS idx_cr_slug_check ON check_results (slug, check_id)");
            $pdo->exec("CREATE INDEX IF NOT EXISTS idx_checks_ts ON checks (checked_at)");
            $pdo->exec("CREATE INDEX IF NOT EXISTS idx_daily_stats_slug ON daily_stats (slug, date)");
        }
    }

    public static function insertCheck(PDO $pdo, int $checkedAt, string $overall, array $results): int
    {
        $stmt = $pdo->prepare('INSERT INTO checks (checked_at, overall) VALUES (?, ?)');
        $stmt->execute([$checkedAt, $overall]);
        $checkId = (int) $pdo->lastInsertId();

        $stmt = $pdo->prepare(
            'INSERT INTO check_results (check_id, slug, status, http_code, latency_ms)
             VALUES (?, ?, ?, ?, ?)'
        );
        foreach ($results as $slug => $r) {
            $stmt->execute([
                $checkId,
                $slug,
                $r['status']     ?? 'unknown',
                $r['code']       ?? null,
                $r['latency_ms'] ?? null,
            ]);
        }

        return $checkId;
    }

    public static function materialiseDailyStats(PDO $pdo, ?string $slug = null): void
    {
        $today = gmdate('Y-m-d');

        if ($slug !== null) {
            $slugs = [$slug];
        } else {
            $stmt = $pdo->query("SELECT DISTINCT slug FROM check_results");
            $slugs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        }

        $driver = $pdo->getAttribute(PDO::ATTR_DRIVER_NAME);
        $sql = $driver === 'mysql'
            ? "INSERT IGNORE INTO daily_stats
                (slug, date, total_checks, up_checks, down_checks, degraded_checks,
                 uptime_pct, down_secs, degraded_secs, avg_latency_ms)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)"
            : "INSERT OR IGNORE INTO daily_stats
                (slug, date, total_checks, up_checks, down_checks, degraded_checks,
                 uptime_pct, down_secs, degraded_secs, avg_latency_ms)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $insert = $pdo->prepare($sql);

        foreach ($slugs as $s) {
            $stmt = $pdo->prepare("
                SELECT MIN(c.checked_at) FROM check_results r
                JOIN checks c ON c.id = r.check_id
                WHERE r.slug = ?
            ");
            $stmt->execute([$s]);
            $earliest = $stmt->fetchColumn();
            if (!$earliest) {
                continue;
            }

            $firstDate = gmdate('Y-m-d', (int) $earliest);
            $cursor = $firstDate;
            while ($cursor < $today) {
                $chk = $pdo->prepare("SELECT 1 FROM daily_stats WHERE slug = ? AND date = ?");
                $chk->execute([$s, $cursor]);
                if ($chk->fetchColumn()) {
                    $cursor = gmdate('Y-m-d', strtotime($cursor . ' +1 day'));
                    continue;
                }

                $rows = self::dayDetailForSlug($pdo, $s, $cursor);
                if (empty($rows)) {
                    $cursor = gmdate('Y-m-d', strtotime($cursor . ' +1 day'));
                    continue;
                }

                $total    = count($rows);
                $up       = count(array_filter($rows, fn($r) => $r['status'] === 'up'));
                $down     = count(array_filter($rows, fn($r) => $r['status'] === 'down'));
                $degraded = count(array_filter($rows, fn($r) => $r['status'] === 'degraded'));

                $latencies = array_filter(
                    array_map(fn($r) => $r['status'] !== 'down' ? (int) $r['latency_ms'] : null, $rows),
                    fn($v) => $v !== null
                );

                $dt = self::calcDowntime($rows);

                $insert->execute([
                    $s,
                    $cursor,
                    $total,
                    $up,
                    $down,
                    $degraded,
                    $total > 0 ? round($up / $total * 100, 2) : null,
                    $dt['down_secs'],
                    $dt['degraded_secs'],
                    $latencies ? (int) round(array_sum($latencies) / count($latencies)) : null,
                ]);

                $cursor = gmdate('Y-m-d', strtotime($cursor . ' +1 day'));
            }
        }
    }

    public static function getDailyStats(PDO $pdo, string $slug, string $from, string $to): array
    {
        $stmt = $pdo->prepare("
            SELECT date, total_checks, up_checks, down_checks, degraded_checks,
                   uptime_pct, down_secs, degraded_secs, avg_latency_ms
            FROM   daily_stats
            WHERE  slug = ? AND date >= ? AND date <= ?
            ORDER  BY date ASC
        ");
        $stmt->execute([$slug, $from, $to]);
        $rows = $stmt->fetchAll();

        $out = [];
        foreach ($rows as $r) {
            $out[$r['date']] = $r;
        }
        return $out;
    }

    public static function historyForSlug(PDO $pdo, string $slug, int $limit = 90): array
    {
        $stmt = $pdo->prepare("
            SELECT c.checked_at AS ts,
                   r.status,
                   r.latency_ms,
                   r.http_code
            FROM   check_results r
            JOIN   checks c ON c.id = r.check_id
            WHERE  r.slug = ?
            ORDER  BY c.checked_at DESC
            LIMIT  ?
        ");
        $stmt->execute([$slug, $limit]);
        return array_reverse($stmt->fetchAll());
    }

    public static function historyFull(PDO $pdo, int $limit = 90): array
    {
        $stmt = $pdo->prepare("
            SELECT id, checked_at, overall
            FROM   checks
            ORDER  BY checked_at DESC
            LIMIT  ?
        ");
        $stmt->execute([$limit]);
        $checks = array_reverse($stmt->fetchAll());

        if (empty($checks)) {
            return [];
        }

        $ids = array_column($checks, 'id');
        $placeholders = implode(',', array_fill(0, count($ids), '?'));

        $stmt = $pdo->prepare("
            SELECT check_id, slug, status, latency_ms, http_code
            FROM   check_results
            WHERE  check_id IN ($placeholders)
        ");
        $stmt->execute($ids);

        $byCheck = [];
        foreach ($stmt->fetchAll() as $r) {
            $byCheck[$r['check_id']][$r['slug']] = [
                'status'     => $r['status'],
                'latency_ms' => $r['latency_ms'],
                'http_code'  => $r['http_code'],
            ];
        }

        $out = [];
        foreach ($checks as $c) {
            $out[] = [
                'ts'       => (int) $c['checked_at'],
                'overall'  => $c['overall'],
                'services' => $byCheck[$c['id']] ?? [],
            ];
        }

        return $out;
    }

    public static function calcDowntime(array $rows): array
    {
        $downSecs     = 0;
        $degradedSecs = 0;
        $spans        = [];

        $n = count($rows);
        if ($n === 0) {
            return ['down_secs' => 0, 'degraded_secs' => 0, 'spans' => []];
        }

        $gaps = [];
        for ($i = 1; $i < $n; $i++) {
            $tsA = (int) ($rows[$i]['checked_at'] ?? $rows[$i]['ts'] ?? 0);
            $tsB = (int) ($rows[$i-1]['checked_at'] ?? $rows[$i-1]['ts'] ?? 0);
            $gap = $tsA - $tsB;
            if ($gap > 0) {
                $gaps[] = $gap;
            }
        }
        sort($gaps);
        $interval = count($gaps) > 0 ? $gaps[(int)(count($gaps) / 2)] : 60;

        $i = 0;
        while ($i < $n) {
            $status = $rows[$i]['status'];
            if ($status !== 'down' && $status !== 'degraded') {
                $i++;
                continue;
            }

            $runStart = (int) ($rows[$i]['checked_at'] ?? $rows[$i]['ts'] ?? 0);
            $runEnd   = $runStart;
            $j = $i;
            while ($j < $n && $rows[$j]['status'] === $status) {
                $runEnd = (int) ($rows[$j]['checked_at'] ?? $rows[$j]['ts'] ?? 0);
                $j++;
            }
            $secs = ($runEnd - $runStart) + $interval;

            $spans[] = [
                'status' => $status,
                'from'   => $runStart,
                'to'     => $runEnd + $interval,
                'secs'   => $secs,
            ];

            if ($status === 'down') {
                $downSecs += $secs;
            }
            if ($status === 'degraded') {
                $degradedSecs += $secs;
            }

            $i = $j;
        }

        return [
            'down_secs'     => $downSecs,
            'degraded_secs' => $degradedSecs,
            'spans'         => $spans,
        ];
    }

    public static function dayDetailForSlug(PDO $pdo, string $slug, string $date): array
    {
        $dayStart = gmmktime(0, 0, 0, (int)substr($date, 5, 2), (int)substr($date, 8, 2), (int)substr($date, 0, 4));
        $dayEnd   = $dayStart + 86400;

        $stmt = $pdo->prepare("
            SELECT c.checked_at AS ts,
                   r.status,
                   r.latency_ms,
                   r.http_code
            FROM   check_results r
            JOIN   checks c ON c.id = r.check_id
            WHERE  r.slug = ?
              AND  c.checked_at >= ?
              AND  c.checked_at <  ?
            ORDER  BY c.checked_at ASC
        ");
        $stmt->execute([$slug, $dayStart, $dayEnd]);
        return $stmt->fetchAll();
    }

    public static function daysForSlug(PDO $pdo, string $slug, int $days = 90): array
    {
        $today     = gmdate('Y-m-d');
        $fromDate = gmdate('Y-m-d', time() - (($days - 1) * 86400));

        self::materialiseDailyStats($pdo, $slug);

        $yesterday = gmdate('Y-m-d', strtotime($today . ' -1 day'));
        $cached    = self::getDailyStats($pdo, $slug, $fromDate, $yesterday);

        // Live-calculate today
        $todayRows = self::dayDetailForSlug($pdo, $slug, $today);
        $todayData = null;
        if (!empty($todayRows)) {
            $total    = count($todayRows);
            $up       = count(array_filter($todayRows, fn($r) => $r['status'] === 'up'));
            $down     = count(array_filter($todayRows, fn($r) => $r['status'] === 'down'));
            $degraded = count(array_filter($todayRows, fn($r) => $r['status'] === 'degraded'));
            $latencies = array_filter(
                array_map(fn($r) => $r['status'] !== 'down' ? (int) $r['latency_ms'] : null, $todayRows),
                fn($v) => $v !== null
            );
            $dt = self::calcDowntime($todayRows);
            $todayData = [
                'date'            => $today,
                'total_checks'    => $total,
                'up_checks'       => $up,
                'down_checks'     => $down,
                'degraded_checks' => $degraded,
                'uptime_pct'      => round($up / $total * 100, 2),
                'outage_pct'      => round($down / $total * 100, 2),
                'avg_latency_ms'  => $latencies ? (int) round(array_sum($latencies) / count($latencies)) : null,
                'had_outage'      => $down > 0,
                'had_degraded'    => $degraded > 0,
                'down_secs'       => $dt['down_secs'],
                'degraded_secs'   => $dt['degraded_secs'],
            ];
        }

        $out = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = gmdate('Y-m-d', time() - $i * 86400);

            if ($date === $today) {
                $out[] = $todayData ?? [
                    'date'            => $today,
                    'total_checks'    => 0,
                    'up_checks'       => 0,
                    'down_checks'     => 0,
                    'degraded_checks' => 0,
                    'uptime_pct'      => null,
                    'outage_pct'      => null,
                    'avg_latency_ms'  => null,
                    'had_outage'      => false,
                    'had_degraded'    => false,
                    'down_secs'       => 0,
                    'degraded_secs'   => 0,
                ];
                continue;
            }

            if (isset($cached[$date])) {
                $r = $cached[$date];
                $out[] = [
                    'date'            => $date,
                    'total_checks'    => (int) $r['total_checks'],
                    'up_checks'       => (int) $r['up_checks'],
                    'down_checks'     => (int) $r['down_checks'],
                    'degraded_checks' => (int) $r['degraded_checks'],
                    'uptime_pct'      => $r['uptime_pct'] !== null ? (float) $r['uptime_pct'] : null,
                    'outage_pct'      => $r['total_checks'] > 0
                        ? round((int) $r['down_checks'] / (int) $r['total_checks'] * 100, 2)
                        : null,
                    'avg_latency_ms'  => $r['avg_latency_ms'] !== null ? (int) $r['avg_latency_ms'] : null,
                    'had_outage'      => (int) $r['down_checks'] > 0,
                    'had_degraded'    => (int) $r['degraded_checks'] > 0,
                    'down_secs'       => (int) $r['down_secs'],
                    'degraded_secs'   => (int) $r['degraded_secs'],
                ];
            } else {
                $out[] = [
                    'date'            => $date,
                    'total_checks'    => 0,
                    'up_checks'       => 0,
                    'down_checks'     => 0,
                    'degraded_checks' => 0,
                    'uptime_pct'      => null,
                    'outage_pct'      => null,
                    'avg_latency_ms'  => null,
                    'had_outage'      => false,
                    'had_degraded'    => false,
                    'down_secs'       => 0,
                    'degraded_secs'   => 0,
                ];
            }
        }

        return $out;
    }

    public static function uptimeStats(PDO $pdo, string $slug, int $days = 90): array
    {
        $today    = gmdate('Y-m-d');
        $fromDate = gmdate('Y-m-d', time() - ($days * 86400));
        $yesterday = gmdate('Y-m-d', strtotime($today . ' -1 day'));

        self::materialiseDailyStats($pdo, $slug);

        $cached = self::getDailyStats($pdo, $slug, $fromDate, $yesterday);

        $todayRows = self::dayDetailForSlug($pdo, $slug, $today);
        if (!empty($todayRows)) {
            $tTotal    = count($todayRows);
            $tUp       = count(array_filter($todayRows, fn($r) => $r['status'] === 'up'));
            $tDown     = count(array_filter($todayRows, fn($r) => $r['status'] === 'down'));
            $tDegraded = count(array_filter($todayRows, fn($r) => $r['status'] === 'degraded'));
            $tLats     = array_filter(
                array_map(fn($r) => $r['status'] !== 'down' ? (int) $r['latency_ms'] : null, $todayRows),
                fn($v) => $v !== null
            );
            $cached[$today] = [
                'total_checks'    => $tTotal,
                'up_checks'       => $tUp,
                'down_checks'     => $tDown,
                'degraded_checks' => $tDegraded,
                'avg_latency_ms'  => $tLats ? (int) round(array_sum($tLats) / count($tLats)) : null,
            ];
        }

        if (empty($cached)) {
            return [
                'uptime_pct'       => null,
                'outage_pct'       => null,
                'avg_latency_ms'   => null,
                'total_checks'     => 0,
                'days_with_outage' => 0,
            ];
        }

        $total = array_sum(array_column($cached, 'total_checks'));
        $up    = array_sum(array_column($cached, 'up_checks'));
        $down  = array_sum(array_column($cached, 'down_checks'));

        $latSum = $latWeight = 0;
        foreach ($cached as $r) {
            $nonDown = (int) $r['total_checks'] - (int) $r['down_checks'];
            if ($nonDown > 0 && $r['avg_latency_ms'] !== null) {
                $latSum    += (int) $r['avg_latency_ms'] * $nonDown;
                $latWeight += $nonDown;
            }
        }

        $outageDays = count(array_filter($cached, fn($r) => (int) $r['down_checks'] > 0));

        return [
            'uptime_pct'       => $total > 0 ? round($up / $total * 100, 3) : null,
            'outage_pct'       => $total > 0 ? round($down / $total * 100, 3) : null,
            'avg_latency_ms'   => $latWeight > 0 ? (int) round($latSum / $latWeight) : null,
            'total_checks'     => $total,
            'days_with_outage' => $outageDays,
        ];
    }
}
