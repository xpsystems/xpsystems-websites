<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;
use App\View;

final class DomainsController extends BaseController
{
    public function index(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $groups = Config::get('domain_groups', []);

        // Separate active and legacy domain groups
        $activeGroups = [];
        $legacyGroup = null;

        foreach ($groups as $group) {
            if (!empty($group['legacy'])) {
                $legacyGroup = $group;
            } else {
                $activeGroups[] = $group;
            }
        }

        $pageData = array_merge($common, [
            'pageTitle'       => 'xpsystems Domains — Domain Portfolio & Network',
            'pageDescription' => 'A comprehensive registry of all domains and infrastructure owned and managed by xpsystems.',
            'activeGroups'    => $activeGroups,
            'legacyGroup'     => $legacyGroup,
        ]);

        $html = View::render('domains/index', $pageData);
        return Response::html($html);
    }
}
