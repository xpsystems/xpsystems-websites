<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Request;
use App\Response;
use App\View;

final class ErrorController extends BaseController
{
    public function notFound(Request $request): Response
    {
        $common = $this->getCommonData($request);
        $pageData = array_merge($common, [
            'pageTitle'       => '404 Not Found — xpsystems',
            'pageDescription' => 'The requested page could not be found.',
        ]);

        $html = View::render('errors/404', $pageData);
        return Response::html($html, 404);
    }
}
