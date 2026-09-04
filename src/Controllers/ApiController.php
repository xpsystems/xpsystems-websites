<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;

final class ApiController
{
    public function handle(Request $request): Response
    {
        // Simple origin/referer check for CSRF/abuse guard
        $origin = $_SERVER['HTTP_ORIGIN'] ?? '';
        $referer = $_SERVER['HTTP_REFERER'] ?? '';
        $host = $request->host;

        $isAllowed = false;
        if ($origin === '' && $referer === '') {
            $isAllowed = true;
        } else {
            $allowedPatterns = ['xpsystems.eu', 'xpsystems.de', 'localhost', '127.0.0.1'];
            foreach ($allowedPatterns as $pattern) {
                if (str_contains($origin, $pattern) || str_contains($referer, $pattern) || str_contains($host, $pattern)) {
                    $isAllowed = true;
                    break;
                }
            }
        }

        if (!$isAllowed) {
            return Response::json(['error' => 'Forbidden'], 403);
        }

        $action = $request->query['action'] ?? '';
        if ($action === '') {
            // Check path like /api/all_repos or /api/org_repos
            $pathParts = explode('/', trim($request->path, '/'));
            if (count($pathParts) >= 2 && $pathParts[0] === 'api') {
                $action = $pathParts[1];
            }
        }

        $result = match ($action) {
            'org_repos'  => $this->handleOrgRepos($request),
            'user_repos' => $this->handleUserRepos($request),
            'org_info'   => $this->handleOrgInfo($request),
            'user_info'  => $this->handleUserInfo($request),
            'all_repos'  => $this->handleAllRepos(),
            default      => ['error' => 'Unknown action: ' . $action],
        };

        $status = isset($result['error']) && !isset($result['_code']) ? 400 : 200;
        return Response::json($result, $status);
    }

    private function githubGet(string $path): mixed
    {
        $token = Config::get('app.github_token', '');
        $url = 'https://api.github.com' . $path;

        $headers = [
            'User-Agent: xpsystems-oss/1.0',
            'Accept: application/vnd.github+json',
            'X-GitHub-Api-Version: 2022-11-28',
        ];
        if (!empty($token)) {
            $headers[] = 'Authorization: Bearer ' . $token;
        }

        $ctx = stream_context_create([
            'http' => [
                'method'        => 'GET',
                'header'        => implode("\r\n", $headers),
                'timeout'       => 8,
                'ignore_errors' => true,
            ],
        ]);

        $raw = @file_get_contents($url, false, $ctx);
        $code = 0;

        foreach ($http_response_header ?? [] as $h) {
            if (preg_match('#^HTTP/\S+\s+(\d+)#', $h, $m)) {
                $code = (int) $m[1];
            }
        }

        if ($raw === false || $code >= 400) {
            return ['_error' => true, '_code' => $code, '_url' => $url];
        }

        return json_decode($raw, true);
    }

    private function githubGetAll(string $path): array
    {
        $page = 1;
        $results = [];

        do {
            $sep = str_contains($path, '?') ? '&' : '?';
            $data = $this->githubGet("{$path}{$sep}per_page=100&page={$page}");

            if (!is_array($data) || isset($data['_error'])) {
                break;
            }
            if (isset($data['id'])) {
                return $data;
            }

            $results = array_merge($results, $data);
            $page++;
        } while (count($data) === 100 && $page <= 5);

        return $results;
    }

    private function handleOrgRepos(Request $request): array
    {
        $org = preg_replace('/[^a-zA-Z0-9\-]/', '', $request->query['org'] ?? '');
        if (!$org) return ['error' => 'Missing org parameter'];
        return $this->githubGetAll("/orgs/{$org}/repos?type=public&sort=updated");
    }

    private function handleUserRepos(Request $request): array
    {
        $user = preg_replace('/[^a-zA-Z0-9\-]/', '', $request->query['user'] ?? '');
        if (!$user) return ['error' => 'Missing user parameter'];
        return $this->githubGetAll("/users/{$user}/repos?type=public&sort=updated");
    }

    private function handleOrgInfo(Request $request): array
    {
        $org = preg_replace('/[^a-zA-Z0-9\-]/', '', $request->query['org'] ?? '');
        if (!$org) return ['error' => 'Missing org parameter'];
        $data = $this->githubGet("/orgs/{$org}");
        return is_array($data) ? $data : ['error' => 'Not found'];
    }

    private function handleUserInfo(Request $request): array
    {
        $user = preg_replace('/[^a-zA-Z0-9\-]/', '', $request->query['user'] ?? '');
        if (!$user) return ['error' => 'Missing user parameter'];
        $data = $this->githubGet("/users/{$user}");
        return is_array($data) ? $data : ['error' => 'Not found'];
    }

    private function handleAllRepos(): array
    {
        $sources = Config::get('github.sources', []);
        $all = [];

        foreach ($sources as $source) {
            $handle = $source['handle'] ?? '';
            $type = $source['type'] ?? 'org';
            if (!$handle) continue;

            $endpoint = $type === 'org'
                ? "/orgs/{$handle}/repos?type=public&sort=updated"
                : "/users/{$handle}/repos?type=public&sort=updated";

            $repos = $this->githubGetAll($endpoint);
            if (is_array($repos) && !isset($repos['_error'])) {
                foreach ($repos as &$r) {
                    $r['_source'] = $handle;
                }
                unset($r);
                $all = array_merge($all, $repos);
            }
        }

        return $all;
    }
}
