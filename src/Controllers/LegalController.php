<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Request;
use App\Response;
use App\View;

final class LegalController extends BaseController
{
    public function impressum(Request $request): Response
    {
        return Response::redirect('https://ternis.dev/en/legal/imprint', 301);
    }

    public function privacy(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $pageData = array_merge($common, [
            'pageTitle'       => 'Privacy Policy — Datenschutzerklärung — xpsystems',
            'pageDescription' => 'Privacy policy and data protection notices for xpsystems.',
        ]);

        $html = View::render('legal/privacy', $pageData);
        return Response::html($html);
    }
}
