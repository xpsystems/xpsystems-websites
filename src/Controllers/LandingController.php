<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;
use App\View;

final class LandingController extends BaseController
{
    public function index(Request $request): Response
    {
        $common = $this->getCommonData($request);

        $services = Config::get('services', []);
        $team = Config::get('team', []);
        $stats = array_map(function (array $stat) use ($request): array {
            if (!empty($stat['url'])) {
                $stat['url'] = $request->url($stat['url']);
            }
            return $stat;
        }, Config::get('stats', []));
        $heroCtas = Config::get('hero_ctas', []);

        $isRework = Config::get('app.under_rework', true) && ($request->query('view') !== 'full');
        $template = $isRework ? 'landing/under-rework' : 'landing/index';
        $pageTitle = $isRework
            ? $common['brand']['name'] . ' — Under Rework // Transition Notice'
            : $common['brand']['name'] . ' — ' . $common['brand']['tagline'];

        $pageData = array_merge($common, [
            'pageTitle'       => $pageTitle,
            'pageDescription' => $common['brand']['transition_notice'],
            'services'        => $services,
            'team'            => $team,
            'stats'           => $stats,
            'heroCtas'        => $heroCtas,
            'statusCheckUrl'  => Config::get('app.status_api_url', 'https://status.xpsystems.eu/api/status'),
        ]);

        $html = View::render($template, $pageData);
        return Response::html($html);
    }
}
