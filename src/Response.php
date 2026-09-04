<?php

declare(strict_types=1);

namespace App;

final class Response
{
    private int $statusCode = 200;
    private array $headers = [];
    private string $content = '';

    public function __construct(string $content = '', int $statusCode = 200, array $headers = [])
    {
        $this->content = $content;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public static function html(string $html, int $status = 200, array $headers = []): self
    {
        $defaultHeaders = [
            'Content-Type' => 'text/html; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
            'X-Frame-Options' => 'SAMEORIGIN',
            'Referrer-Policy' => 'strict-origin-when-cross-origin',
        ];
        return new self($html, $status, array_merge($defaultHeaders, $headers));
    }

    public static function json(mixed $data, int $status = 200, array $headers = []): self
    {
        $defaultHeaders = [
            'Content-Type' => 'application/json; charset=UTF-8',
            'X-Content-Type-Options' => 'nosniff',
        ];
        $json = json_encode($data, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return new self($json !== false ? $json : '{}', $status, array_merge($defaultHeaders, $headers));
    }

    public static function redirect(string $url, int $status = 302): self
    {
        return new self('', $status, ['Location' => $url]);
    }

    public static function file(string $filePath): self
    {
        if (!file_exists($filePath) || is_dir($filePath)) {
            return new self('Not Found', 404, ['Content-Type' => 'text/plain']);
        }

        $extension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css'   => 'text/css; charset=UTF-8',
            'js'    => 'application/javascript; charset=UTF-8',
            'json'  => 'application/json; charset=UTF-8',
            'png'   => 'image/png',
            'jpg'   => 'image/jpeg',
            'jpeg'  => 'image/jpeg',
            'svg'   => 'image/svg+xml',
            'ico'   => 'image/x-icon',
            'webp'  => 'image/webp',
            'woff'  => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf'   => 'font/ttf',
        ];

        $contentType = $mimeTypes[$extension] ?? 'application/octet-stream';
        $content = (string) file_get_contents($filePath);

        $headers = [
            'Content-Type'   => $contentType,
            'Content-Length' => (string) strlen($content),
            'Cache-Control'  => 'public, max-age=86400',
            'X-Content-Type-Options' => 'nosniff',
        ];

        return new self($content, 200, $headers);
    }

    public function send(): void
    {
        if (!headers_sent()) {
            http_response_code($this->statusCode);
            foreach ($this->headers as $key => $value) {
                header("{$key}: {$value}");
            }
        }
        echo $this->content;
    }
}
