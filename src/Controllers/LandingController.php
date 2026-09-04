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

        $pageData = array_merge($common, [
            'pageTitle'       => $common['brand']['name'] . ' — ' . $common['brand']['tagline'],
            'pageDescription' => $common['brand']['description'],
            'services'        => $services,
            'team'            => $team,
            'stats'           => $stats,
            'heroCtas'        => $heroCtas,
            'statusCheckUrl'  => Config::get('app.status_api_url', 'https://status.xpsystems.eu/api/status'),
        ]);

        $html = View::render('landing/index', $pageData);
        return Response::html($html);
    }
}
