<?php

declare(strict_types=1);

namespace App\Status;

use App\Config;
use PDO;

final class StatusService
{
    private array $config;
    private ?PDO $pdo = null;

    public function __construct(?array $config = null)
    {
        $this->config = $config ?? Config::get('status') ?? (require dirname(__DIR__, 2) . '/config/status.php');
    }

    public function getConfig(): array
    {
        return $this->config;
    }

    public function getPdo(): ?PDO
    {
        if ($this->pdo === null && ($this->config['db']['driver'] ?? 'none') !== 'none') {
            try {
                $this->pdo = Database::connect($this->config);
            } catch (\Throwable $e) {
                error_log('[StatusService] DB connect error: ' . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    public function getCachedStatus(): array
    {
        $cacheFile = $this->config['cache']['path'];
        $cacheDir  = $this->config['cache']['dir'];

        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        $data = null;
        $stale = true;

        if (file_exists($cacheFile)) {
            $raw = json_decode((string) file_get_contents($cacheFile), true);
            if (is_array($raw)) {
                $data = $raw;
                $age = time() - (int) filemtime($cacheFile);
                $stale = $age >= (int)($this->config['cache']['ttl'] ?? 90);
            }
        }

        if ($stale) {
            $this->triggerBackgroundCheck();
        }

        return $data ?? ['checked_at' => time(), 'services' => [], 'overall' => 'operational'];
    }

    public function triggerBackgroundCheck(): void
    {
        $lock = ($this->config['cache']['dir'] ?? (dirname(__DIR__, 2) . '/data/status')) . '/check.lock';
        if (file_exists($lock) && (time() - filemtime($lock)) < 60) {
            return;
        }
        touch($lock);

        $config = $this->config;

        if (function_exists('fastcgi_finish_request')) {
            register_shutdown_function(function () use ($config, $lock) {
                fastcgi_finish_request();
                Checker::run($config);
                @unlink($lock);
            });
        } else {
            // Asynchronous execution via CLI or shutdown hook
            register_shutdown_function(function () use ($config, $lock) {
                Checker::run($config);
                @unlink($lock);
            });
        }
    }

    public function getFullStatus(): array
    {
        $cached = $this->getCachedStatus();
        $raw    = $cached['services'] ?? [];

        $services    = [];
        $notDeployed = [];

        foreach ($this->config['services'] as $svc) {
            if (!empty($svc['is_deployed'])) {
                $r = $raw[$svc['slug']] ?? ['status' => 'operational', 'code' => 200, 'latency_ms' => 15];
                $services[] = [
                    'slug'        => $svc['slug'],
                    'name'        => $svc['name'],
                    'group'       => $svc['group'],
                    'url'         => $svc['url'],
                    'is_deployed' => true,
                    'status'      => $r['status'] ?? 'up',
                    'http_code'   => $r['code'] ?? null,
                    'latency_ms'  => $r['latency_ms'] ?? null,
                ];
            } else {
                $notDeployed[] = [
                    'slug'        => $svc['slug'],
                    'name'        => $svc['name'],
                    'group'       => $svc['group'],
                    'url'         => $svc['url'],
                    'is_deployed' => false,
                    'status'      => 'not_deployed',
                    'http_code'   => null,
                    'latency_ms'  => null,
                ];
            }
        }

        $statuses = array_column($services, 'status');
        $overall  = match (true) {
            in_array('down', $statuses, true)     => 'major_outage',
            in_array('degraded', $statuses, true) => 'partial_outage',
            default                               => 'operational',
        };

        return [
            'overall'    => $overall,
            'checked_at' => $cached['checked_at'] ?? time(),
            'services'   => [...$services, ...$notDeployed],
        ];
    }

    public function getDaysForSlug(string $slug, int $days = 90): array
    {
        $pdo = $this->getPdo();
        if ($pdo !== null) {
            try {
                return Database::daysForSlug($pdo, $slug, $days);
            } catch (\Throwable $e) {
                error_log('[StatusService] daysForSlug DB error: ' . $e->getMessage());
            }
        }

        // Fallback to JSON history
        $historyFile = $this->config['history']['path'] ?? '';
        if (file_exists($historyFile)) {
            $raw = json_decode((string) file_get_contents($historyFile), true);
            if (is_array($raw)) {
                $rows = [];
                foreach ($raw as $entry) {
                    if (isset($entry['services'][$slug])) {
                        $s = $entry['services'][$slug];
                        $rows[] = [
                            'ts'         => (int)($entry['ts'] ?? time()),
                            'status'     => $s['status'] ?? 'up',
                            'latency_ms' => $s['latency_ms'] ?? null,
                        ];
                    }
                }
                return Stats::calcDays($rows, $days);
            }
        }

        return Stats::calcDays([], $days);
    }

    public function getUptimeStatsForSlug(string $slug, int $days = 90): array
    {
        $pdo = $this->getPdo();
        if ($pdo !== null) {
            try {
                return Database::uptimeStats($pdo, $slug, $days);
            } catch (\Throwable $e) {
                error_log('[StatusService] uptimeStats DB error: ' . $e->getMessage());
            }
        }

        $daysData = $this->getDaysForSlug($slug, $days);
        return Stats::summaryFromDays($daysData);
    }

    public function getDayDetail(string $slug, string $date): array
    {
        $pdo = $this->getPdo();
        $checks = [];

        if ($pdo !== null) {
            try {
                $checks = Database::dayDetailForSlug($pdo, $slug, $date);
            } catch (\Throwable $e) {
                error_log('[StatusService] getDayDetail DB error: ' . $e->getMessage());
            }
        }

        $total    = count($checks);
        $up       = count(array_filter($checks, fn($r) => $r['status'] === 'up'));
        $down     = count(array_filter($checks, fn($r) => $r['status'] === 'down'));
        $degraded = count(array_filter($checks, fn($r) => $r['status'] === 'degraded'));

        $latencies = array_filter(
            array_map(fn($r) => $r['status'] !== 'down' ? (int) $r['latency_ms'] : null, $checks),
            fn($v) => $v !== null
        );

        $dt = Database::calcDowntime($checks);

        return [
            'slug'      => $slug,
            'date'      => $date,
            'summary'   => [
                'uptime_pct'       => $total > 0 ? round($up / $total * 100, 2) : 100,
                'down_secs'        => $dt['down_secs'],
                'degraded_secs'    => $dt['degraded_secs'],
                'avg_latency_ms'   => $latencies ? (int) round(array_sum($latencies) / count($latencies)) : null,
                'total_checks'     => $total,
            ],
            'checks'    => $checks,
            'incidents' => $dt['spans'],
        ];
    }
}
