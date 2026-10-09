<?php

/**
 * URL Helpers
 * Helper functions for URL manipulation and generation
 */

if (!function_exists('url')) {
    function url(string $path = '', array $params = []): string
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
}

if (!function_exists('current_url')) {
    function current_url(bool $withQuery = true): string
    {
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? 'https://' : 'http://';
        $url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        if (!$withQuery) {
            $url = strtok($url, '?');
        }

        return $url;
    }
}

if (!function_exists('previous_url')) {
    function previous_url(): ?string
    {
        return $_SERVER['HTTP_REFERER'] ?? null;
    }
}

if (!function_exists('url_encode')) {
    function url_encode(string $string): string
    {
        return urlencode($string);
    }
}

if (!function_exists('url_decode')) {
    function url_decode(string $string): string
    {
        return urldecode($string);
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        $path = ltrim($path, '/');
        return url("/assets/$path");
    }
}

if (!function_exists('route')) {
    function route(string $name, array $parameters = []): string
    {
        $routes = config('routes', []);
        
        if (!isset($routes[$name])) {
            return url('/');
        }

        $path = $routes[$name];
        
        foreach ($parameters as $key => $value) {
            $path = str_replace("{$key}", $value, $path);
        }

        return url($path);
    }
}

if (!function_exists('query_string')) {
    function query_string(): string
    {
        return $_SERVER['QUERY_STRING'] ?? '';
    }
}

if (!function_exists('redirect')) {
    function redirect(string $url, int $code = 302): void
    {
        header('Location: ' . $url, true, $code);
        exit;
    }
}
