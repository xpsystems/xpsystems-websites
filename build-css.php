#!/usr/bin/env php
<?php
/**
 * SCSS Build Script
 * Compiles assets/scss/main.scss → assets/css/build.css via scssphp.
 *
 * Usage:
 *   php build-css.php           — only compile if sources are stale
 *   php build-css.php --force   — always recompile
 *   php build-css.php --minify  — produce compressed output
 *
 * Typically called from the pre-commit git hook.
 */

require_once __DIR__ . '/vendor/autoload.php';

use App\ScssCompiler;

$force  = in_array('--force',  $argv ?? [], true);
$minify = in_array('--minify', $argv ?? [], true);

$outFile = __DIR__ . '/public/assets/css/build.css';

try {
    $wasStale = ScssCompiler::isStale();

    ScssCompiler::compile(force: $force, minify: $minify);

    if ($wasStale || $force) {
        $size = file_exists($outFile) ? round(filesize($outFile) / 1024, 1) : 0;
        echo "[scss] ✓ Compiled → assets/css/build.css ({$size} KB)\n";
    } else {
        echo "[scss] ↑ build.css is up-to-date, skipping.\n";
    }

    exit(0);
} catch (\RuntimeException $e) {
    fwrite(STDERR, "[scss] ✗ " . $e->getMessage() . "\n");
    exit(1);
}
