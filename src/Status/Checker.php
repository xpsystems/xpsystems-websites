<?php

declare(strict_types=1);

namespace App\Status;

final class Checker
{
    public static function pingUrl(string $url, int $timeout, string $ua): array
    {
        $start = microtime(true);

        if (!function_exists('curl_init')) {
            return ['status' => 'unknown', 'code' => null, 'latency_ms' => null];
        }

        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => $timeout,
            CURLOPT_CONNECTTIMEOUT => $timeout,
            CURLOPT_USERAGENT      => $ua,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS      => 3,
            CURLOPT_NOBODY         => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_HEADER         => false,
        ]);

        curl_exec($ch);
        $code = (int) curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $err  = curl_errno($ch);

        $latency = (int) round((microtime(true) - $start) * 1000);

        if ($err !== 0 || $code === 0) {
            return ['status' => 'down', 'code' => null, 'latency_ms' => $latency];
        }
        if ($code >= 500) {
            return ['status' => 'degraded', 'code' => $code, 'latency_ms' => $latency];
        }

        return ['status' => 'up', 'code' => $code, 'latency_ms' => $latency];
    }

    public static function run(array $config): array
    {
        $timeout = (int)($config['ping']['timeout'] ?? 6);
        $ua      = (string)($config['ping']['useragent'] ?? 'xpsystems-statusbot/1.0');

        $deployedServices = array_filter($config['services'] ?? [], fn($s) => !empty($s['is_deployed']));

        $results = [];
        foreach ($deployedServices as $svc) {
            $results[$svc['slug']] = self::pingUrl($svc['ping_url'], $timeout, $ua);
        }

        // Derive overall
        $statuses = array_column($results, 'status');
        $overall = match (true) {
            in_array('down', $statuses, true)     => 'major_outage',
            in_array('degraded', $statuses, true) => 'partial_outage',
            default                               => 'operational',
        };

        $now = time();
        $payload = [
            'checked_at' => $now,
            'overall'    => $overall,
            'services'   => $results,
        ];

        // Write cache
        $cacheDir = $config['cache']['dir'] ?? (dirname(__DIR__, 2) . '/data/status');
        if (!is_dir($cacheDir)) {
            mkdir($cacheDir, 0755, true);
        }

        $cacheFile = $config['cache']['path'] ?? ($cacheDir . '/status.json');
        $tmp = $cacheFile . '.tmp.' . bin2hex(random_bytes(4));
        file_put_contents($tmp, json_encode($payload, JSON_PRETTY_PRINT));
        rename($tmp, $cacheFile);

        // Record in Database
        $driver = $config['db']['driver'] ?? 'none';
        if ($driver !== 'none') {
            try {
                $pdo = Database::connect($config);
                Database::insertCheck($pdo, $now, $overall, $results);
            } catch (\Throwable $e) {
                error_log('[xps-checker] DB error: ' . $e->getMessage());
            }
        }

        return $payload;
    }
}
