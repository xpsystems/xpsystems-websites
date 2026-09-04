<?php

declare(strict_types=1);

namespace App;

use App\Controllers\LandingController;
use App\Controllers\ContactController;
use App\Controllers\DomainsController;
use App\Controllers\OpenSourceController;
use App\Controllers\ApiController;
use App\Controllers\LegalController;
use App\Controllers\ErrorController;

final class Router
{
    public static function dispatch(Request $request): Response
    {
        $path = rtrim($request->path, '/');
        if ($path === '') {
            $path = '/';
        }

        $subdomain = $request->getSubdomainNormalized();

        // 1. API routes (support both api.php, /api/..., and direct queries)
        if ($path === '/api' || $path === '/api.php' || str_starts_with($path, '/api/')) {
            return (new ApiController())->handle($request);
        }

        // 2. Subdomain-specific dispatching
        switch ($subdomain) {
            case 'contact':
                return self::dispatchContact($request, $path);

            case 'domains':
                return self::dispatchDomains($request, $path);

            case 'opensource':
                return self::dispatchOpenSource($request, $path);

            case 'main':
            default:
                // Main domain (xpsystems.eu, xpsystems.de, www, localhost, etc.)
                // Also handles paths: /contact, /domains, /opensource, /impressum, /privacy
                return self::dispatchMain($request, $path);
        }
    }

    private static function dispatchContact(Request $request, string $path): Response
    {
        if ($path === '/' || $path === '/contact') {
            return (new ContactController())->index($request);
        }
        if ($path === '/impressum') {
            return (new LegalController())->impressum($request);
        }
        if ($path === '/privacy') {
            return (new LegalController())->privacy($request);
        }
        return (new ErrorController())->notFound($request);
    }

    private static function dispatchDomains(Request $request, string $path): Response
    {
        if ($path === '/' || $path === '/domains') {
            return (new DomainsController())->index($request);
        }
        if ($path === '/impressum') {
            return (new LegalController())->impressum($request);
        }
        if ($path === '/privacy') {
            return (new LegalController())->privacy($request);
        }
        return (new ErrorController())->notFound($request);
    }

    private static function dispatchOpenSource(Request $request, string $path): Response
    {
        if ($path === '/' || $path === '/opensource') {
            return (new OpenSourceController())->index($request);
        }
        if ($path === '/impressum') {
            return (new LegalController())->impressum($request);
        }
        if ($path === '/privacy') {
            return (new LegalController())->privacy($request);
        }
        return (new ErrorController())->notFound($request);
    }

    private static function dispatchMain(Request $request, string $path): Response
    {
        // Path routing on main domain or localhost
        return match ($path) {
            '/' => (new LandingController())->index($request),
            '/contact' => (new ContactController())->index($request),
            '/domains' => (new DomainsController())->index($request),
            '/opensource' => (new OpenSourceController())->index($request),
            '/impressum' => (new LegalController())->impressum($request),
            '/privacy' => (new LegalController())->privacy($request),
            default => (new ErrorController())->notFound($request),
        };
    }
}
