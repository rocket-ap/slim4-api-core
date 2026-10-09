<?php

namespace System\Core;

/**
 * Cookie Management
 * Handles setting, getting, and deleting cookies
 */
class Cookie
{
    private static array $defaults = [
        'expires' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax',
    ];

    /**
     * Set a cookie
     */
    public static function set(string $name, mixed $value, array $options = []): bool
    {
        $options = array_merge(self::$defaults, $options);

        if (is_array($value) || is_object($value)) {
            $value = json_encode($value);
        }

        return setcookie(
            $name,
            (string) $value,
            [
                'expires' => $options['expires'],
                'path' => $options['path'],
                'domain' => $options['domain'],
                'secure' => $options['secure'],
                'httponly' => $options['httponly'],
                'samesite' => $options['samesite'],
            ]
        );
    }

    /**
     * Get a cookie value
     */
    public static function get(string $name, mixed $default = null): mixed
    {
        if (!isset($_COOKIE[$name])) {
            return $default;
        }

        $value = $_COOKIE[$name];

        // Try to decode JSON
        $decoded = json_decode($value, true);
        if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
            return $decoded;
        }

        return $value;
    }

    /**
     * Check if a cookie exists
     */
    public static function has(string $name): bool
    {
        return isset($_COOKIE[$name]);
    }

    /**
     * Delete a cookie
     */
    public static function delete(string $name): bool
    {
        if (!isset($_COOKIE[$name])) {
            return false;
        }

        unset($_COOKIE[$name]);
        return setcookie($name, '', ['expires' => -1]);
    }

    /**
     * Get all cookies
     */
    public static function all(): array
    {
        return $_COOKIE;
    }

    /**
     * Clear all cookies
     */
    public static function flush(): void
    {
        foreach ($_COOKIE as $name => $value) {
            self::delete($name);
        }
    }
}
