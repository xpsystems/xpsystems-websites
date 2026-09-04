<?php

declare(strict_types=1);

/**
 * Root index.php delegator
 * Allows running directly from project root (e.g. php -S localhost:8080)
 * or via standard Apache / Nginx setups.
 */

// Route static asset requests if built-in PHP webserver is used
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?? '/');
$filePath = __DIR__ . $uri;

if ($uri !== '/' && file_exists($filePath) && !is_dir($filePath)) {
    return false;
}

require_once __DIR__ . '/public/index.php';
