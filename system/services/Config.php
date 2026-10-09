<?php

namespace System\Services;

/**
 * Configuration Service
 * Manages application configuration
 */
class Config
{
    private static array $configs = [];

    /**
     * Load configuration
     */
    public static function load(string $key = null, mixed $default = null): mixed
    {
        if (empty(self::$configs)) {
            $configDir = PATH_CONFIG;
            $files = glob($configDir . '/*.php');

            foreach ($files as $file) {
                $name = basename($file, '.php');
                self::$configs[$name] = require $file;
            }
        }

        if ($key === null) {
            return self::$configs;
        }

        $segments = explode('.', $key);
        $value = self::$configs;

        foreach ($segments as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }

    /**
     * Get configuration
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        return self::load($key, $default);
    }

    /**
     * Set configuration
     */
    public static function set(string $key, mixed $value): void
    {
        self::load();
        $segments = explode('.', $key);
        $current = &self::$configs;

        foreach ($segments as $segment) {
            if (!isset($current[$segment])) {
                $current[$segment] = [];
            }
            $current = &$current[$segment];
        }

        $current = $value;
    }
}
