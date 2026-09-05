<?php

declare(strict_types=1);

namespace App\Status;

final class Stats
{
    /**
     * Calculate real downtime seconds from a set of check rows for a given status.
     * Rows must have a 'ts' or 'checked_at' key (unix timestamp), sorted ASC.
     */
    public static function calcDowntimeSecs(array $rows, string $targetStatus): int
    {
        if (empty($rows)) {
            return 0;
        }

        $tsKey = isset($rows[0]['ts']) ? 'ts' : 'checked_at';

        // Estimate median check interval
        $gaps = [];
        $n = count($rows);
        for ($i = 1; $i < $n; $i++) {
            $gap = (int)$rows[$i][$tsKey] - (int)$rows[$i - 1][$tsKey];
            if ($gap > 0) {
                $gaps[] = $gap;
            }
        }
        sort($gaps);
        $interval = count($gaps) > 0 ? $gaps[(int)(count($gaps) / 2)] : 60;

        $secs = 0;
        $i = 0;
        while ($i < $n) {
            if ($rows[$i]['status'] !== $targetStatus) {
                $i++;
                continue;
            }
            $runStart = (int)$rows[$i][$tsKey];
            $runEnd = $runStart;
            while ($i < $n && $rows[$i]['status'] === $targetStatus) {
                $runEnd = (int)$rows[$i][$tsKey];
                $i++;
            }
            $secs += ($runEnd - $runStart) + $interval;
        }
        return $secs;
    }

    /**
     * Aggregate an array of check rows into per-day buckets.
     */
    public static function calcDays(array $rows, int $days = 90): array
    {
        $byDay = [];
        foreach ($rows as $row) {
            $date = gmdate('Y-m-d', (int) ($row['ts'] ?? $row['checked_at']));
            $byDay[$date][] = $row;
        }

        $out = [];
        for ($i = $days - 1; $i >= 0; $i--) {
            $date = gmdate('Y-m-d', time() - $i * 86400);
            $checks = $byDay[$date] ?? [];

            if (empty($checks)) {
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
                continue;
            }

            $total = count($checks);
            $up = count(array_filter($checks, fn($r) => $r['status'] === 'up'));
            $down = count(array_filter($checks, fn($r) => $r['status'] === 'down'));
            $degraded = count(array_filter($checks, fn($r) => $r['status'] === 'degraded'));

            $latencies = array_filter(
                array_map(fn($r) => $r['status'] !== 'down' ? ($r['latency_ms'] ?? null) : null, $checks),
                fn($v) => $v !== null
            );

            $out[] = [
                'date'            => $date,
                'total_checks'    => $total,
                'up_checks'       => $up,
                'down_checks'     => $down,
                'degraded_checks' => $degraded,
                'uptime_pct'      => round($up / $total * 100, 2),
                'outage_pct'      => round($down / $total * 100, 2),
                'avg_latency_ms'  => $latencies ? (int) round(array_sum($latencies) / count($latencies)) : null,
                'had_outage'      => $down > 0,
                'had_degraded'    => $degraded > 0,
                'down_secs'       => self::calcDowntimeSecs($checks, 'down'),
                'degraded_secs'   => self::calcDowntimeSecs($checks, 'degraded'),
            ];
        }

        return $out;
    }

    /**
     * Classify a day entry into a status class string.
     */
    public static function dayStatus(array $day): string
    {
        if (($day['total_checks'] ?? 0) === 0) {
            return 'unknown';
        }

        $outagePct = $day['outage_pct'] ?? 0;

        if ($outagePct > 50)  return 'outage-critical';
        if ($outagePct > 10)  return 'outage-major';
        if ($outagePct > 0)   return 'outage-minor';
        if (!empty($day['had_degraded'])) return 'degraded';
        return 'up';
    }

    /**
     * Compute a summary from already-aggregated day entries.
     */
    public static function summaryFromDays(array $days): array
    {
        $total = array_sum(array_column($days, 'total_checks'));
        $up    = array_sum(array_column($days, 'up_checks'));
        $down  = array_sum(array_column($days, 'down_checks'));

        if ($total === 0) {
            return [
                'uptime_pct'       => null,
                'outage_pct'       => null,
                'avg_latency_ms'   => null,
                'total_checks'     => 0,
                'days_with_outage' => 0,
            ];
        }

        $latSum = 0;
        $latWeight = 0;
        foreach ($days as $d) {
            $nonDown = $d['total_checks'] - $d['down_checks'];
            if ($nonDown > 0 && ($d['avg_latency_ms'] ?? null) !== null) {
                $latSum += $d['avg_latency_ms'] * $nonDown;
                $latWeight += $nonDown;
            }
        }

        return [
            'uptime_pct'       => round($up / $total * 100, 3),
            'outage_pct'       => round($down / $total * 100, 3),
            'avg_latency_ms'   => $latWeight > 0 ? (int) round($latSum / $latWeight) : null,
            'total_checks'     => $total,
            'days_with_outage' => count(array_filter($days, fn($d) => !empty($d['had_outage']))),
        ];
    }
}
