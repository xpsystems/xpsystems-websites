<?php

declare(strict_types=1);

/**
 * Root index.php delegator
 * Allows running directly from project root (e.g. php -S localhost:8080)
 * or via standard Apache / Nginx setups (docroot = public/).
 *
 * Static asset resolution order:
 *   1. <project-root><uri>   — e.g. root-level files (robots.txt etc.)
 *   2. public/<uri>          — the actual webroot (css, js, images, etc.)
 */

$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');

// 1. File exists at project root (e.g. /robots.txt)
$rootPath = __DIR__ . $uri;
if ($uri !== '/' && file_exists($rootPath) && !is_dir($rootPath)) {
    return false;
}

// 2. File exists inside public/ (assets, js, images — the real webroot)
$publicPath = __DIR__ . '/public' . $uri;
if ($uri !== '/' && file_exists($publicPath) && !is_dir($publicPath)) {
    // Determine MIME type and serve it manually
    $ext = strtolower(pathinfo($publicPath, PATHINFO_EXTENSION));
    $mimes = [
        'css'  => 'text/css',
        'js'   => 'application/javascript',
        'png'  => 'image/png',
        'jpg'  => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif'  => 'image/gif',
        'svg'  => 'image/svg+xml',
        'ico'  => 'image/x-icon',
        'woff' => 'font/woff',
        'woff2'=> 'font/woff2',
        'ttf'  => 'font/ttf',
        'map'  => 'application/json',
    ];
    if (isset($mimes[$ext])) {
        header('Content-Type: ' . $mimes[$ext]);
    }
    readfile($publicPath);
    exit;
}

require_once __DIR__ . '/public/index.php';
