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
use App\ScssCompiler;

// Initialize app configuration
Config::init();

// Auto-compile SCSS → build.css when sources are stale.
// In production the pre-commit hook ensures build.css is already present,
// so isStale() returns false and this is effectively a no-op.
// In local development this recompiles automatically on every request where
// a .scss file has changed — no manual build step required.
try {
    ScssCompiler::compileIfStale();
} catch (\RuntimeException $e) {
    // Log SCSS errors without crashing the whole request
    error_log('[ScssCompiler] ' . $e->getMessage());
}

// Capture incoming HTTP request
$request = Request::capture();

// Dispatch and send response
$response = Router::dispatch($request);
$response->send();

