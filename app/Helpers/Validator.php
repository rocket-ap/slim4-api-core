<?php

namespace App\Helpers;

class Url
{
    public static function to(string $path = '', array $params = []): string
    {
        $baseUrl = env('APP_URL', 'http://localhost');
        $baseUrl = rtrim($baseUrl, '/');
        $path = '/' . ltrim($path, '/');
        $url = $baseUrl . $path;

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }

        return $url;
    }

    public static function base(string $path = ''): string
    {
        return self::to($path);
    }

    public static function current(bool $withQuery = true): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || ($_SERVER['SERVER_PORT'] ?? 0) == 443 ? 'https://' : 'http://';
        $url = $protocol . ($_SERVER['HTTP_HOST'] ?? 'localhost') . ($_SERVER['REQUEST_URI'] ?? '/');

        if (!$withQuery) {
            $url = strtok($url, '?');
        }

        return $url;
    }

    public static function previous(): ?string
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }

    public static function encode(string $value): string
    {
        return urlencode($value);
    }

    public static function decode(string $value): string
    {
        return urldecode($value);
    }

    public static function asset(string $path): string
    {
        return self::to('/assets/' . ltrim($path, '/'));
    }

    public static function route(string $name, array $parameters = []): string
    {
        $routes = config('routes', []);
        if (!isset($routes[$name])) {
            return self::to('/');
        }

        $path = $routes[$name];
        foreach ($parameters as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        return self::to($path);
    }

    public static function queryString(): string
    {
        return $_SERVER['QUERY_STRING'] ?? '';
    }

    public static function redirect(string $location, int $code = 302): void
    {
        header('Location: ' . $location, true, $code);
        exit;
    }
}
