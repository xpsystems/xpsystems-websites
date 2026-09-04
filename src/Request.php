<?php

declare(strict_types=1);

namespace App;

final class Request
{
    public readonly string $host;
    public readonly string $hostname;
    public readonly int $port;
    public readonly string $subdomain;
    public readonly string $tld;
    public readonly string $method;
    public readonly string $uri;
    public readonly string $path;
    public readonly array $query;
    public readonly bool $isHttps;

    public function __construct(
        ?string $host = null,
        ?string $uri = null,
        ?string $method = null,
        ?bool $isHttps = null
    ) {
        $rawHost = $host ?? $_SERVER['HTTP_HOST'] ?? 'xpsystems.eu';
        if (str_contains($rawHost, ':')) {
            [$extractedHost, $portStr] = explode(':', $rawHost, 2);
            $this->port = (int) $portStr;
        } else {
            $extractedHost = $rawHost;
            $this->port = isset($_SERVER['SERVER_PORT']) ? (int)$_SERVER['SERVER_PORT'] : 80;
        }

        $this->method = strtoupper($method ?? $_SERVER['REQUEST_METHOD'] ?? 'GET');
        $rawUri = $uri ?? $_SERVER['REQUEST_URI'] ?? '/';
        $this->uri = $rawUri;

        $parsedUrl = parse_url($rawUri);
        $this->path = rawurldecode($parsedUrl['path'] ?? '/');
        
        $queryParams = [];
        if (!empty($parsedUrl['query'])) {
            parse_str($parsedUrl['query'], $queryParams);
        } else {
            $queryParams = $_GET ?? [];
        }
        $this->query = $queryParams;

        // Support ?domain= (or ?host=) override for dev server testing
        $simulatedDomain = $queryParams['domain'] ?? $queryParams['host'] ?? null;
        if (!empty($simulatedDomain) && is_string($simulatedDomain)) {
            $simulatedDomain = strtolower(trim($simulatedDomain));
            if (!str_contains($simulatedDomain, '.')) {
                $simulatedDomain .= '.xpsystems.eu';
            }
            $activeHost = $simulatedDomain;
            $activeHostname = $simulatedDomain;
        } else {
            $activeHost = strtolower($extractedHost);
            $activeHostname = $extractedHost;
        }

        $this->hostname = $activeHostname;
        $this->host = $activeHost;

        $this->isHttps = $isHttps ?? (
            (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
            || ($_SERVER['SERVER_PORT'] ?? 80) == 443
            || (($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? '') === 'https')
        );

        $this->subdomain = $this->detectSubdomain($this->host);
        $this->tld = $this->detectTld($this->host);
    }

    public static function capture(): self
    {
        return new self();
    }

    private function detectSubdomain(string $host): string
    {
        // Check for local dev hosts or IP addresses
        if ($host === 'localhost' || $host === '127.0.0.1' || str_ends_with($host, '.localhost')) {
            if (str_ends_with($host, '.localhost')) {
                return str_replace('.localhost', '', $host);
            }
            return '';
        }

        // Strip known root domains like xpsystems.eu, xpsystems.de, xpsys.eu, etc.
        $knownDomains = ['xpsystems.eu', 'xpsystems.de', 'xpsys.eu', 'xpsys.de'];
        foreach ($knownDomains as $domain) {
            if ($host === $domain) {
                return '';
            }
            if (str_ends_with($host, '.' . $domain)) {
                $sub = substr($host, 0, -strlen('.' . $domain));
                return $sub;
            }
        }

        // Generic fallback: check if hostname has > 2 parts
        $parts = explode('.', $host);
        if (count($parts) > 2) {
            array_pop($parts); // remove tld
            array_pop($parts); // remove domain name
            return implode('.', $parts);
        }

        return '';
    }

    private function detectTld(string $host): string
    {
        $parts = explode('.', $host);
        return count($parts) > 1 ? end($parts) : 'eu';
    }

    public function getSubdomainNormalized(): string
    {
        $sub = $this->subdomain;
        if ($sub === '' || $sub === 'www') {
            return 'main';
        }
        if ($sub === 'oss') {
            return 'opensource';
        }
        return $sub;
    }
}
