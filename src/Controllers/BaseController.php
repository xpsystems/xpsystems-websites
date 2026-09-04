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
            $homeUrl = 'https://xpsystems.' . $request->tld;
            $nav[] = ['label' => 'Home', 'href' => $homeUrl, 'external' => false];
        }

        foreach ($rawNav as $item) {
            // Check context filter if specified
            if (isset($item['contexts']) && !in_array($currentContext, $item['contexts'], true)) {
                continue;
            }

            // Adapt URLs to match current TLD (.eu or .de)
            $href = $item['href'];
            if (str_contains($href, 'xpsystems.eu') && $request->tld === 'de') {
                $href = str_replace('xpsystems.eu', 'xpsystems.de', $href);
            }

            $nav[] = [
                'label'    => $item['label'],
                'href'     => $href,
                'external' => $item['external'] ?? false,
                'active'   => (isset($item['route']) && $item['route'] === $request->path)
                              || (isset($item['label']) && strtolower($item['label']) === $currentContext),
            ];
        }

        // Adapt footer links to match current TLD
        $footerLinks = [];
        foreach (Config::get('footer_links', []) as $fl) {
            $href = $fl['href'];
            if (str_contains($href, 'xpsystems.eu') && $request->tld === 'de') {
                $href = str_replace('xpsystems.eu', 'xpsystems.de', $href);
            }
            $footerLinks[] = [
                'label' => $fl['label'],
                'href'  => $href,
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
