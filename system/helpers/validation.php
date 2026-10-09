<?php

/**
 * Validation Helpers
 * Helper functions for data validation
 */

if (!function_exists('is_email')) {
    function is_email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
}

if (!function_exists('is_url')) {
    function is_url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }
}

if (!function_exists('is_ip')) {
    function is_ip(string $ip, int $type = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, $type) !== false;
    }
}

if (!function_exists('is_ipv4')) {
    function is_ipv4(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }
}

if (!function_exists('is_ipv6')) {
    function is_ipv6(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}

if (!function_exists('is_numeric_check')) {
    function is_numeric_check(string $value): bool
    {
        return is_numeric($value);
    }
}

if (!function_exists('is_uuid')) {
    function is_uuid(string $uuid): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $uuid) === 1;
    }
}

if (!function_exists('is_phone')) {
    function is_phone(string $phone): bool
    {
        $phone = preg_replace('/[^0-9+\\-\\s]/', '', $phone);
        return preg_match('/^\\+?[1-9]\\d{1,14}$/', $phone) === 1;
    }
}

if (!function_exists('is_json')) {
    function is_json(string $string): bool
    {
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
}

if (!function_exists('is_date')) {
    function is_date(string $date, string $format = 'Y-m-d'): bool
    {
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}

if (!function_exists('is_alpha')) {
    function is_alpha(string $value): bool
    {
        return ctype_alpha($value);
    }
}

if (!function_exists('is_alpha_numeric')) {
    function is_alpha_numeric(string $value): bool
    {
        return ctype_alnum($value);
    }
}

if (!function_exists('is_slug')) {
    function is_slug(string $value): bool
    {
        return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value) === 1;
    }
}

if (!function_exists('is_base64')) {
    function is_base64(string $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $decoded = base64_decode($value, true);
        if ($decoded === false) {
            return false;
        }

        return base64_encode($decoded) === $value;
    }
}

if (!function_exists('is_empty')) {
    function is_empty(mixed $value): bool
    {
        return empty($value);
    }
}
