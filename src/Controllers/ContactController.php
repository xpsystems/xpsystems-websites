<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Request;
use App\Response;
use App\View;

final class ContactController extends BaseController
{
    public function index(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $contact = Config::get('contact', []);

        $pageData = array_merge($common, [
            'pageTitle'       => 'xpsystems Contact — Get in Touch',
            'pageDescription' => $contact['description'] ?? 'Contact information for xpsystems.',
            'contact'         => $contact,
        ]);

        $html = View::render('contact/index', $pageData);
        return Response::html($html);
    }
}
