<?php

declare(strict_types=1);

namespace App;

final class View
{
    private static string $viewsPath = '';

    public static function setPath(string $path): void
    {
        self::$viewsPath = rtrim($path, '/\\');
    }

    public static function render(string $template, array $data = []): string
    {
        if (empty(self::$viewsPath)) {
            self::$viewsPath = dirname(__DIR__) . '/src/Views';
        }

        $templateFile = self::$viewsPath . '/' . ltrim($template, '/') . '.php';

        if (!file_exists($templateFile)) {
            throw new \RuntimeException("View template not found: {$templateFile}");
        }

        // Helper functions available inside template
        $e = static function (mixed $value): string {
            return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        };

        $component = static function (string $name, array $params = []) use ($data): void {
            echo View::render('components/' . $name, array_merge($data, $params));
        };

        // Extract variables into current scope
        extract($data, EXTR_SKIP);

        ob_start();
        try {
            require $templateFile;
            return (string) ob_get_clean();
        } catch (\Throwable $th) {
            ob_end_clean();
            throw $th;
        }
    }
}
