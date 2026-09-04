<?php

declare(strict_types=1);

use App\Request;

if (!function_exists('url')) {
    /**
     * Generate context- and environment-aware URL.
     * In local dev (localhost, 127.0.0.1), uses ?domain= query parameter.
     * In production, generates proper absolute or relative URLs.
     */
    function url(string $target = '/', string|array|null $subdomainOrParams = null, array $params = []): string
    {
        return Request::buildUrl($target, $subdomainOrParams, $params);
    }
}
