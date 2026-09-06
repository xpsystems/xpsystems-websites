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
    public readonly bool $isLocal;

    private static ?Request $current = null;

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

        $cleanExtracted = strtolower(trim($extractedHost));
        $this->isLocal = in_array($cleanExtracted, ['localhost', '127.0.0.1', '0.0.0.0', '::1', '[::1]'], true)
            || str_ends_with($cleanExtracted, '.localhost')
            || str_ends_with($cleanExtracted, '.test')
            || str_ends_with($cleanExtracted, '.local')
            || (filter_var($cleanExtracted, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) === false && filter_var($cleanExtracted, FILTER_VALIDATE_IP) !== false);

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

        self::$current = $this;
    }

    public static function capture(): self
    {
        $instance = new self();
        self::$current = $instance;
        return $instance;
    }

    public static function current(): ?self
    {
        return self::$current;
    }

    public static function setCurrent(?Request $request): void
    {
        self::$current = $request;
    }

    public function query(?string $key = null, mixed $default = null): mixed
    {
        if ($key === null) {
            return $this->query;
        }
        return $this->query[$key] ?? $default;
    }

    /**
     * Generate context- and environment-aware URL.
     * In local environments (localhost), generates relative URLs with ?domain= parameter.
     * In production, generates proper absolute URLs across domains/subdomains.
     */
    public function url(string $target = '/', string|array|null $subdomainOrParams = null, array $params = []): string
    {
        return self::buildUrl($target, $subdomainOrParams, $params, $this);
    }

    public static function buildUrl(
        string $target = '/',
        string|array|null $subdomainOrParams = null,
        array $params = [],
        ?Request $request = null
    ): string {
        $req = $request ?? self::$current ?? new self();

        // 1. Handle anchor, mailto, tel, javascript, data URLs untouched
        $trimmed = trim($target);
        if ($trimmed === '') {
            $trimmed = '/';
        }
        if (str_starts_with($trimmed, '#')
            || str_starts_with($trimmed, 'mailto:')
            || str_starts_with($trimmed, 'tel:')
            || str_starts_with($trimmed, 'javascript:')
            || str_starts_with($trimmed, 'data:')
        ) {
            return $target;
        }

        // 2. Resolve parameters & explicit subdomain
        $queryParams = [];
        $explicitSubdomain = null;
        if (is_array($subdomainOrParams)) {
            $queryParams = $subdomainOrParams;
        } elseif (is_string($subdomainOrParams) && $subdomainOrParams !== '') {
            $explicitSubdomain = strtolower(trim($subdomainOrParams));
            $queryParams = $params;
        } else {
            $queryParams = $params;
        }

        // 3. Parse target
        $targetPath = '/';
        $targetSubdomain = $explicitSubdomain;
        $targetTld = $req->tld;
        $fragment = '';

        if (preg_match('#^https?://#i', $trimmed)) {
            $parsed = parse_url($trimmed);
            $parsedHost = strtolower($parsed['host'] ?? '');
            $targetPath = $parsed['path'] ?? '/';
            $fragment = isset($parsed['fragment']) ? '#' . $parsed['fragment'] : '';

            if (!empty($parsed['query'])) {
                $targetQuery = [];
                parse_str($parsed['query'], $targetQuery);
                $queryParams = array_merge($targetQuery, $queryParams);
            }

            // Internal xpsystems host recognition (including status domains)
            $internalHosts = [
                'xpsystems.eu'        => ['sub' => 'main', 'tld' => 'eu'],
                'xpsystems.de'        => ['sub' => 'main', 'tld' => 'de'],
                'xpsys.de'            => ['sub' => 'main', 'tld' => 'de'],
                'xpsys.eu'            => ['sub' => 'main', 'tld' => 'eu'],
                'www.xpsystems.eu'    => ['sub' => 'main', 'tld' => 'eu'],
                'www.xpsystems.de'    => ['sub' => 'main', 'tld' => 'de'],
                'www.xpsys.de'        => ['sub' => 'main', 'tld' => 'de'],
                'contact.xpsystems.eu' => ['sub' => 'contact', 'tld' => 'eu'],
                'contact.xpsystems.de' => ['sub' => 'contact', 'tld' => 'de'],
                'domains.xpsystems.eu' => ['sub' => 'domains', 'tld' => 'eu'],
                'domains.xpsystems.de' => ['sub' => 'domains', 'tld' => 'de'],
                'opensource.xpsystems.eu' => ['sub' => 'opensource', 'tld' => 'eu'],
                'opensource.xpsystems.de' => ['sub' => 'opensource', 'tld' => 'de'],
                'oss.xpsystems.eu'    => ['sub' => 'opensource', 'tld' => 'eu'],
                'oss.xpsystems.de'    => ['sub' => 'opensource', 'tld' => 'de'],
                'status.xpsystems.eu' => ['sub' => 'status', 'tld' => 'eu'],
                'status.xpsystems.de' => ['sub' => 'status', 'tld' => 'de'],
                'status.xpsys.de'     => ['sub' => 'status', 'tld' => 'de'],
                'status.xpsys.eu'     => ['sub' => 'status', 'tld' => 'eu'],
            ];

            if (isset($internalHosts[$parsedHost])) {
                $targetSubdomain = $internalHosts[$parsedHost]['sub'];
                $targetTld = $internalHosts[$parsedHost]['tld'];
            } elseif (
                $parsedHost === 'localhost'
                || $parsedHost === '127.0.0.1'
                || str_ends_with($parsedHost, '.localhost')
            ) {
                if (empty($targetSubdomain) && isset($queryParams['domain'])) {
                    $targetSubdomain = $queryParams['domain'];
                }
            } else {
                // Truly external URL: keep untouched
                $queryString = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
                return $target . $queryString;
            }
        } else {
            // Check for fragment in relative target
            if (str_contains($trimmed, '#')) {
                [$trimmed, $frag] = explode('#', $trimmed, 2);
                $fragment = '#' . $frag;
            }

            // Check for query in relative target
            if (str_contains($trimmed, '?')) {
                [$trimmed, $qStr] = explode('?', $trimmed, 2);
                $targetQuery = [];
                parse_str($qStr, $targetQuery);
                $queryParams = array_merge($targetQuery, $queryParams);
            }

            // Check if target is a known subdomain keyword
            $knownSubdomains = [
                'main'       => 'main',
                'home'       => 'main',
                'root'       => 'main',
                'status'     => 'status',
                'contact'    => 'contact',
                'domains'    => 'domains',
                'opensource' => 'opensource',
                'oss'        => 'opensource',
            ];

            $cleanKey = trim(strtolower($trimmed), '/');
            if (isset($knownSubdomains[$cleanKey])) {
                $targetSubdomain = $knownSubdomains[$cleanKey];
                $targetPath = '/';
            } else {
                $targetPath = $trimmed !== '' ? $trimmed : '/';
            }
        }

        // Normalize path
        if (!str_starts_with($targetPath, '/')) {
            $targetPath = '/' . $targetPath;
        }

        // 4. Build URL depending on local vs production
        if ($req->isLocal) {
            $domainParam = null;

            if ($targetSubdomain !== null) {
                if (in_array($targetSubdomain, ['contact', 'domains', 'opensource', 'status'], true)) {
                    $domainParam = $targetTld === 'de'
                        ? $targetSubdomain . '.xpsystems.de'
                        : $targetSubdomain;
                } elseif ($targetSubdomain === 'main') {
                    if ($targetTld === 'de') {
                        $domainParam = 'xpsystems.de';
                    } elseif (!empty($req->query['domain']) && $req->getSubdomainNormalized() !== 'main') {
                        $domainParam = 'main';
                    }
                }
            } elseif (!empty($req->query['domain'])) {
                // Preserve active domain override on internal paths (e.g. /impressum?domain=contact)
                $domainParam = $req->query['domain'];
            }

            if ($domainParam !== null && !isset($queryParams['domain'])) {
                $queryParams['domain'] = $domainParam;
            }

            $queryStr = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
            return $targetPath . $queryStr . $fragment;
        }

        // Production environment
        if ($targetSubdomain !== null) {
            $baseDomain = str_contains($req->host, 'xpsys.') ? 'xpsys.' : 'xpsystems.';
            $prodHost = match ($targetSubdomain) {
                'contact'    => 'contact.' . $baseDomain . $targetTld,
                'domains'    => 'domains.' . $baseDomain . $targetTld,
                'opensource' => 'opensource.' . $baseDomain . $targetTld,
                'status'     => (str_contains($req->host, 'xpsys.de') || $targetTld === 'de' && str_contains($req->host, 'xpsys'))
                    ? 'status.xpsys.de'
                    : 'status.xpsystems.' . $targetTld,
                'main'       => $baseDomain . $targetTld,
                default      => $req->host,
            };

            $queryStr = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
            return 'https://' . $prodHost . $targetPath . $queryStr . $fragment;
        }

        $queryStr = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        return $targetPath . $queryStr . $fragment;
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
