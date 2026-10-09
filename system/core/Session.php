<?php

namespace System\Core;

/**
 * Session Management
 * Handles session data
 */
class Session
{
    private static bool $started = false;

    /**
     * Initialize session
     */
    public static function init(): void
    {
        if (!self::$started && session_status() === PHP_SESSION_NONE) {
            session_start();
            self::$started = true;
        }
    }

    /**
     * Set session value
     */
    public static function set(string $key, mixed $value): void
    {
        self::init();
        $_SESSION[$key] = $value;
    }

    /**
     * Get session value
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        self::init();
        return $_SESSION[$key] ?? $default;
    }

    /**
     * Check if session key exists
     */
    public static function has(string $key): bool
    {
        self::init();
        return isset($_SESSION[$key]);
    }

    /**
     * Delete session key
     */
    public static function delete(string $key): void
    {
        self::init();
        unset($_SESSION[$key]);
    }

    /**
     * Get all session data
     */
    public static function all(): array
    {
        self::init();
        return $_SESSION;
    }

    /**
     * Clear all session data
     */
    public static function flush(): void
    {
        self::init();
        $_SESSION = [];
    }

    /**
     * Destroy session
     */
    public static function destroy(): void
    {
        self::init();
        session_destroy();
        self::$started = false;
    }

    /**
     * Regenerate session ID
     */
    public static function regenerate(): void
    {
        self::init();
        session_regenerate_id(true);
    }
}
