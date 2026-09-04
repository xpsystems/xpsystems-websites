<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;

abstract class BaseController
{
    protected function getCommonData(Request $request): array
    {
        $currentContext = $request->getSubdomainNormalized();
        $isSubdomain = in_array($currentContext, ['contact', 'domains', 'opensource'], true);

        // Compute context-aware navigation links
        $nav = [];
        $rawNav = Config::get('nav', []);
        
        // Add Home link if on a subdomain or non-root
        if ($isSubdomain) {
            $nav[] = ['label' => 'Home', 'href' => $request->url('main'), 'external' => false];
        }

        foreach ($rawNav as $item) {
            // Check context filter if specified
            if (isset($item['contexts']) && !in_array($currentContext, $item['contexts'], true)) {
                continue;
            }

            $resolvedHref = $request->url($item['href']);
            $isExternal = $item['external'] ?? false;
            // On local dev server, internal routes stay within same tab
            if ($request->isLocal && (str_starts_with($resolvedHref, '/') || str_starts_with($resolvedHref, '#'))) {
                $isExternal = false;
            }

            $nav[] = [
                'label'    => $item['label'],
                'href'     => $resolvedHref,
                'external' => $isExternal,
                'active'   => (isset($item['route']) && $item['route'] === $request->path)
                              || (isset($item['label']) && strtolower($item['label']) === $currentContext),
            ];
        }

        // Adapt footer links using url helper
        $footerLinks = [];
        foreach (Config::get('footer_links', []) as $fl) {
            $footerLinks[] = [
                'label' => $fl['label'],
                'href'  => $request->url($fl['href']),
            ];
        }

        return [
            'request'        => $request,
            'brand'          => Config::get('brand', []),
            'app'            => Config::get('app', []),
            'nav'            => $nav,
            'footer_links'   => $footerLinks,
            'currentContext' => $currentContext,
            'currentTld'     => $request->tld,
            'currentYear'    => (int) date('Y'),
        ];
    }
}
