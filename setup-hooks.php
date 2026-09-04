#!/usr/bin/env php
<?php
/**
 * setup-hooks.php
 *
 * Installs the .githooks/pre-commit hook into .git/hooks/pre-commit
 * and configures git to use the .githooks directory.
 *
 * Run once after cloning:
 *   php setup-hooks.php
 */

$root = __DIR__;
$hooksSrc = $root . '/.githooks/pre-commit';
$gitHooksDir = $root . '/.git/hooks';
$hookDst = $gitHooksDir . '/pre-commit';

if (!is_dir($gitHooksDir)) {
    fwrite(STDERR, "Error: .git/hooks directory not found. Are you in the repo root?\n");
    exit(1);
}

// Copy the hook
copy($hooksSrc, $hookDst);
chmod($hookDst, 0755);

echo "✓ Pre-commit hook installed at .git/hooks/pre-commit\n";

// Also configure git hooksPath so all team members get hooks from .githooks/
exec("git config core.hooksPath .githooks", $out, $code);
if ($code === 0) {
    echo "✓ git core.hooksPath set to .githooks/\n";
} else {
    echo "⚠ Could not set core.hooksPath automatically. Run manually:\n";
    echo "  git config core.hooksPath .githooks\n";
}

echo "\nDone. Run `php build-css.php` to compile SCSS manually.\n";
