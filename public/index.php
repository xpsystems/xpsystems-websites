<?php

declare(strict_types=1);

/**
 * xpsystems Multi-Domain / Multi-Subdomain Entry Point
 * Handles:
 *  - xpsystems.eu, xpsystems.de
 *  - www.xpsystems.eu, www.xpsystems.de
 *  - contact.xpsystems.eu, contact.xpsystems.de
 *  - domains.xpsystems.eu, domains.xpsystems.de
 *  - opensource.xpsystems.eu, opensource.xpsystems.de
 *  - /api endpoints
 */

require_once dirname(__DIR__) . '/src/autoload.php';

use App\Config;
use App\Request;
use App\Router;

// Initialize app configuration
Config::init();

// Capture incoming HTTP request
$request = Request::capture();

// Dispatch and send response
$response = Router::dispatch($request);
$response->send();
