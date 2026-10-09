<?php

/**
 * System Helpers
 * Global helper functions for the application
 */

if (!function_exists('env')) {
    function env(string $key, mixed $default = null): mixed
    {
        $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);

        if ($value === false || $value === null) {
            return $default;
        }

        if (is_string($value) && strtolower($value) === 'true') {
            return true;
        }

        if (is_string($value) && strtolower($value) === 'false') {
            return false;
        }

        if (is_numeric($value)) {
            return $value + 0;
        }

        return $value;
    }
}

if (!function_exists('config')) {
    function config(?string $key = null, mixed $default = null): mixed
    {
        static $configs = [];

        if (empty($configs)) {
            $configDir = PATH_CONFIG;
            if (is_dir($configDir)) {
                $files = glob($configDir . '/*.php');

                if (is_array($files)) {
                    foreach ($files as $file) {
                        $name = basename($file, '.php');
                        if ($name !== 'index') {
                            $configs[$name] = require $file;
                        }
                    }
                }
            }
        }

        if ($key === null) {
            return $configs;
        }

        $segments = explode('.', $key);
        $value = $configs;

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }
}

if (!function_exists('configs')) {
    function configs(): array
    {
        return config();
    }
}

if (!function_exists('path')) {
    function path(string $key, mixed $default = null): mixed
    {
        $paths = [
            'root' => PATH_ROOT,
            'system' => PATH_SYSTEM,
            'app' => PATH_APP,
            'config' => PATH_CONFIG,
            'storage' => PATH_STORAGE,
            'public' => PATH_PUBLIC,
            'bootstrap' => PATH_BOOTSTRAP,
            'core' => PATH_CORE,
            'services' => PATH_SERVICES,
            'logs' => PATH_LOGS,
            'cache' => PATH_CACHE,
            'temp' => PATH_TEMP,
            'sessions' => PATH_SESSIONS,
            'exceptions' => PATH_EXCEPTIONS,
        ];

        return $paths[$key] ?? $default;
    }
}

if (!function_exists('base_path')) {
    function base_path(string $path = ''): string
    {
        return PATH_ROOT . ($path !== '' ? DS . ltrim($path, '/\\') : '');
    }
}

if (!function_exists('public_path')) {
    function public_path(string $path = ''): string
    {
        return PATH_PUBLIC . ($path !== '' ? DS . ltrim($path, '/\\') : '');
    }
}

if (!function_exists('storage_path')) {
    function storage_path(string $path = ''): string
    {
        return PATH_STORAGE . ($path !== '' ? DS . ltrim($path, '/\\') : '');
    }
}

if (!function_exists('config_path')) {
    function config_path(string $path = ''): string
    {
        return PATH_CONFIG . ($path !== '' ? DS . ltrim($path, '/\\') : '');
    }
}

if (!function_exists('getIpAddress')) {
    function getIpAddress(): string
    {
        foreach (['HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'] as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = $_SERVER[$key];
                if (strpos($ip, ',') !== false) {
                    $ip = trim(explode(',', $ip)[0]);
                }
                return $ip;
            }
        }

        return '0.0.0.0';
    }
}

if (!function_exists('now')) {
    function now(): int
    {
        return time();
    }
}

if (!function_exists('uuid')) {
    function uuid(): string
    {
        return strtolower(str_replace(['-', ' '], '', preg_replace('/[^A-Za-z0-9]/', '', microtime() . uniqid('', true))));
    }
}

if (!function_exists('random_string')) {
    function random_string(int $length = 16): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}

if (!function_exists('logger')) {
    function logger(): mixed
    {
        static $logger = null;

        if ($logger === null) {
            $logConfig = config('app.logging');
            $logger = new \System\Services\Logger($logConfig);
        }

        return $logger;
    }
}

if (!function_exists('dd')) {
    function dd(...$vars): void
    {
        foreach ($vars as $var) {
            var_dump($var);
        }
        die(1);
    }
}

if (!function_exists('dump')) {
    function dump(...$vars): void
    {
        foreach ($vars as $var) {
            var_dump($var);
        }
    }
}

if (!function_exists('load_system_helpers')) {
    function load_system_helpers(): void
    {
        $helperDir = PATH_SYSTEM . DS . 'helpers';

        if (!is_dir($helperDir)) {
            return;
        }

        $files = glob($helperDir . DS . '*.php');
        if (!is_array($files)) {
            return;
        }

        sort($files, SORT_STRING);

        foreach ($files as $file) {
            require_once $file;
        }
    }
}

load_system_helpers();
