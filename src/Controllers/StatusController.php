<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;
use App\View;
use App\Status\Checker;
use App\Status\Database;
use App\Status\Stats;
use App\Status\StatusService;

final class StatusController extends BaseController
{
    private StatusService $service;

    public function __construct(?StatusService $service = null)
    {
        $this->service = $service ?? new StatusService();
    }

    public function index(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $config = $this->service->getConfig();
        $fullData = $this->service->getFullStatus();
        $overall = $fullData['overall'];
        $services = $fullData['services'];
        $checkedAt = $fullData['checked_at'];

        $servicesByGroup = [];
        foreach ($config['groups'] as $group) {
            $servicesByGroup[$group] = array_values(
                array_filter($services, fn($s) => ($s['group'] ?? '') === $group)
            );
        }

        $svcHistory = [];
        foreach ($services as $svc) {
            if (!empty($svc['is_deployed'])) {
                $svcHistory[$svc['slug']] = $this->service->getDaysForSlug($svc['slug'], 90);
            }
        }

        $deployedCount = count(array_filter($services, fn($s) => !empty($s['is_deployed'])));
        $upCount = count(array_filter($services, fn($s) => !empty($s['is_deployed']) && ($s['status'] ?? '') === 'up'));

        $cacheFile = $config['cache']['path'] ?? '';
        $cacheAge = file_exists($cacheFile) ? (time() - (int)filemtime($cacheFile)) : 0;

        $pageData = array_merge($common, [
            'pageTitle'        => 'System Status — xpsystems infrastructure',
            'pageDescription'  => 'Real-time telemetry, European network operational status, 90-day historical uptime records, and day incident diagnostics.',
            'request'          => $request,
            'config'           => $config,
            'overall'          => $overall,
            'services'         => $services,
            'servicesByGroup'  => $servicesByGroup,
            'svcHistory'       => $svcHistory,
            'checkedAt'        => $checkedAt,
            'deployedCount'    => $deployedCount,
            'upCount'          => $upCount,
            'cacheAge'         => $cacheAge,
            'activeHost'       => $request->host,
        ]);

        $html = View::render('status/index', $pageData);
        return Response::html($html);
    }

    public function apiDocs(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $config = $this->service->getConfig();

        $pageData = array_merge($common, [
            'pageTitle'       => 'Status API Reference — xpsystems',
            'pageDescription' => 'Public REST JSON API documentation for xpsystems status metrics, historical checks, and uptime telemetry.',
            'request'         => $request,
            'config'          => $config,
            'endpoints'       => $config['api_endpoints'] ?? [],
            'activeHost'      => $request->host,
        ]);

        $html = View::render('status/api-docs', $pageData);
        return Response::html($html);
    }

    public function api(Request $request): Response
    {
        $uri = rtrim($request->path, '/');
        $config = $this->service->getConfig();

        $corsHeaders = [
            'Content-Type'                 => 'application/json; charset=utf-8',
            'Access-Control-Allow-Origin'  => '*',
            'Access-Control-Allow-Methods' => 'GET, OPTIONS',
            'Access-Control-Allow-Headers' => 'Accept, Content-Type, Authorization',
            'Cache-Control'                => 'no-store, no-cache, must-revalidate',
            'X-Robots-Tag'                 => 'noindex',
        ];

        if ($request->method === 'OPTIONS') {
            return new Response('', 204, $corsHeaders);
        }

        // GET /api/ping
        if ($uri === '/api/ping') {
            return Response::json([
                'pong'      => true,
                'timestamp' => time(),
                'server'    => $request->host,
            ], 200, $corsHeaders);
        }

        // GET /api/status
        if ($uri === '/api/status' || $uri === '/api') {
            $data = $this->service->getFullStatus();
            $deployed = array_filter($data['services'], fn($s) => !empty($s['is_deployed']));

            return Response::json([
                'overall'    => $data['overall'],
                'checked_at' => $data['checked_at'],
                'server'     => $request->host,
                'summary'    => [
                    'total'        => count($deployed),
                    'up'           => count(array_filter($deployed, fn($s) => $s['status'] === 'up')),
                    'degraded'     => count(array_filter($deployed, fn($s) => $s['status'] === 'degraded')),
                    'down'         => count(array_filter($deployed, fn($s) => $s['status'] === 'down')),
                    'unknown'      => count(array_filter($deployed, fn($s) => $s['status'] === 'unknown')),
                    'not_deployed' => count(array_filter($data['services'], fn($s) => empty($s['is_deployed']))),
                ],
            ], 200, $corsHeaders);
        }

        // GET /api/services
        if ($uri === '/api/services') {
            $data = $this->service->getFullStatus();
            return Response::json([
                'checked_at' => $data['checked_at'],
                'services'   => $data['services'],
            ], 200, $corsHeaders);
        }

        // GET /api/service/{slug}
        if (preg_match('#^/api/service/([a-z0-9\-]+)$#', $uri, $m)) {
            $slug = $m[1];
            $data = $this->service->getFullStatus();
            foreach ($data['services'] as $svc) {
                if ($svc['slug'] === $slug) {
                    return Response::json([
                        'checked_at' => $data['checked_at'],
                        'service'    => $svc,
                    ], 200, $corsHeaders);
                }
            }
            return Response::json(['error' => 'Service not found', 'slug' => $slug], 404, $corsHeaders);
        }

        // GET /api/history[?limit=N]
        if ($uri === '/api/history') {
            $limit = min((int)($request->query['limit'] ?? 90), 1440);
            $pdo = $this->service->getPdo();
            if ($pdo !== null) {
                try {
                    $out = Database::historyFull($pdo, $limit);
                    return Response::json(['count' => count($out), 'entries' => $out], 200, $corsHeaders);
                } catch (\Throwable $e) {
                    error_log('[StatusController] historyFull error: ' . $e->getMessage());
                }
            }

            $historyFile = $config['history']['path'] ?? '';
            $raw = file_exists($historyFile) ? json_decode((string)file_get_contents($historyFile), true) : [];
            $out = is_array($raw) ? array_slice($raw, -$limit) : [];
            return Response::json(['count' => count($out), 'entries' => $out], 200, $corsHeaders);
        }

        // GET /api/history/{slug}[?days=N]
        if (preg_match('#^/api/history/([a-z0-9\-]+)$#', $uri, $m)) {
            $slug = $m[1];
            $days = min((int)($request->query['days'] ?? 90), 3650);

            $daysData = $this->service->getDaysForSlug($slug, $days);
            $summary = $this->service->getUptimeStatsForSlug($slug, $days);

            return Response::json([
                'slug'           => $slug,
                'days_requested' => $days,
                'summary'        => $summary,
                'days'           => $daysData,
            ], 200, $corsHeaders);
        }

        // GET /api/day/{slug}/{YYYY-MM-DD}
        if (preg_match('#^/api/day/([a-z0-9\-]+)/([0-9]{4}-[0-9]{2}-[0-9]{2})$#', $uri, $m)) {
            $slug = $m[1];
            $date = $m[2];

            $detail = $this->service->getDayDetail($slug, $date);
            return Response::json($detail, 200, $corsHeaders);
        }

        return Response::json(['error' => 'Not found', 'path' => $uri], 404, $corsHeaders);
    }

    public function events(Request $request): Response
    {
        // Server-Sent Events stream
        header('Content-Type: text/event-stream; charset=utf-8');
        header('Cache-Control: no-store, no-cache');
        header('X-Accel-Buffering: no');
        header('Access-Control-Allow-Origin: *');

        while (ob_get_level()) {
            ob_end_clean();
        }
        ob_implicit_flush(true);

        $payload = $this->service->getFullStatus();

        echo "event: status\n";
        echo 'data: ' . json_encode($payload, JSON_UNESCAPED_UNICODE) . "\n\n";
        flush();

        // Send keepalive comment and terminate request smoothly
        echo ": keepalive\n\n";
        flush();
        exit(0);
    }

    public function check(Request $request): Response
    {
        $config = $this->service->getConfig();
        $token = $config['check']['token'] ?? '';

        if ($token !== '' && ($request->query['token'] ?? '') !== $token) {
            return Response::json(['error' => 'Forbidden — invalid or missing token'], 403);
        }

        $result = Checker::run($config);
        return Response::json([
            'success' => true,
            'result'  => $result,
        ], 200);
    }
}
