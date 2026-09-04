<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;
use App\View;

final class OpenSourceController extends BaseController
{
    public function index(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $githubConfig = Config::get('github', []);
        $team = Config::get('team', []);

        $pageData = array_merge($common, [
            'pageTitle'       => 'Open Source — xpsystems',
            'pageDescription' => 'Everything we build, in the open. Explore our repositories, tools, and infrastructure projects at xpsystems.',
            'sources'         => $githubConfig['sources'] ?? [],
            'teamMembers'     => $team,
            'projectGithub'   => 'https://github.com/xpsystems',
        ]);

        $html = View::render('opensource/index', $pageData);
        return Response::html($html);
    }
}
