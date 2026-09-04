<?php

declare(strict_types=1);

namespace App;

final class Config
{
    private static ?array $data = null;

    public static function init(?array $config = null): void
    {
        if ($config !== null) {
            self::$data = $config;
            return;
        }

        $configFile = dirname(__DIR__) . '/config/app.php';
        if (file_exists($configFile)) {
            self::$data = require $configFile;
        } else {
            self::$data = [];
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        if (self::$data === null) {
            self::init();
        }

        $segments = explode('.', $key);
        $current = self::$data;

        foreach ($segments as $segment) {
            if (!is_array($current) || !array_key_exists($segment, $current)) {
                return $default;
            }
            $current = $current[$segment];
        }

        return $current;
    }

    public static function all(): array
    {
        if (self::$data === null) {
            self::init();
        }
        return self::$data ?? [];
    }
}
