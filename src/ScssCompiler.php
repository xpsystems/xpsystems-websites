<?php

declare(strict_types=1);

namespace App;

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

/**
 * ScssCompiler
 *
 * Compiles assets/scss/main.scss → assets/css/build.css using scssphp.
 * Zero Node.js / npm required.
 *
 * Usage:
 *   ScssCompiler::compile();                   // uses defaults
 *   ScssCompiler::compile(force: true);        // skip mtime check, always recompile
 *   ScssCompiler::compileIfStale();            // only recompile when source is newer
 *   ScssCompiler::isStale();                   // bool – true if rebuild needed
 */
final class ScssCompiler
{
    /** Absolute path to SCSS entry point */
    private const SCSS_ENTRY = __DIR__ . '/../assets/scss/main.scss';

    /** Absolute path to compiled CSS output (Apache webroot is public/) */
    private const CSS_OUT    = __DIR__ . '/../public/assets/css/build.css';

    /** SCSS load path (partials directory) */
    private const SCSS_DIR   = __DIR__ . '/../assets/scss';

    /**
     * Compile SCSS → CSS.
     *
     * @param bool $force   If true, always recompile regardless of mtime.
     * @param bool $minify  If true, output compressed CSS (default: false → expanded).
     *
     * @throws \RuntimeException on compile failure.
     */
    public static function compile(bool $force = false, bool $minify = false): void
    {
        if (!$force && !self::isStale()) {
            return;
        }

        $compiler = new Compiler();
        $compiler->setImportPaths([self::SCSS_DIR]);
        $compiler->setOutputStyle(
            $minify ? OutputStyle::COMPRESSED : OutputStyle::EXPANDED
        );

        try {
            $result = $compiler->compileString(
                file_get_contents(self::SCSS_ENTRY),
                self::SCSS_ENTRY
            );

            $outDir = dirname(self::CSS_OUT);
            if (!is_dir($outDir)) {
                mkdir($outDir, 0755, true);
            }

            file_put_contents(self::CSS_OUT, $result->getCss());
        } catch (\Exception $e) {
            throw new \RuntimeException(
                'SCSS compilation failed: ' . $e->getMessage(),
                0,
                $e
            );
        }
    }

    /**
     * Recompile only when any SCSS partial is newer than the output CSS.
     */
    public static function compileIfStale(): void
    {
        self::compile(force: false);
    }

    /**
     * Returns true when the SCSS sources are newer than the compiled output,
     * or when the output file does not exist yet.
     */
    public static function isStale(): bool
    {
        if (!file_exists(self::CSS_OUT)) {
            return true;
        }

        $outMtime = filemtime(self::CSS_OUT);

        // Walk all .scss files in the scss directory
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator(self::SCSS_DIR)
        );

        foreach ($iterator as $file) {
            /** @var \SplFileInfo $file */
            if ($file->isFile() && $file->getExtension() === 'scss') {
                if ($file->getMTime() > $outMtime) {
                    return true;
                }
            }
        }

        return false;
    }
}
