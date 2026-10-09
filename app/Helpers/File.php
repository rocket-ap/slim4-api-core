<?php

namespace App\Helpers;

class Validator
{
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    public static function ip(string $ip, int $flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, $flags) !== false;
    }

    public static function ipv4(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    public static function ipv6(string $ip): bool
    {
        return filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }

    public static function numeric(string $value): bool
    {
        return is_numeric($value);
    }

    public static function uuid(string $value): bool
    {
        return preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}$/i', $value) === 1;
    }

    public static function phone(string $value): bool
    {
        $value = preg_replace('/[^0-9+\-\s]/', '', $value);
        return preg_match('/^\+?[1-9]\d{1,14}$/', $value) === 1;
    }

    public static function json(string $value): bool
    {
        json_decode($value);
        return json_last_error() === JSON_ERROR_NONE;
    }

    public static function date(string $value, string $format = 'Y-m-d'): bool
    {
        $date = \DateTime::createFromFormat($format, $value);
        return $date && $date->format($format) === $value;
    }

    public static function alpha(string $value): bool
    {
        return ctype_alpha($value);
    }

    public static function alphaNumeric(string $value): bool
    {
        return ctype_alnum($value);
    }

    public static function slug(string $value): bool
    {
        return preg_match('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', $value) === 1;
    }

    public static function base64(string $value): bool
    {
        $decoded = base64_decode($value, true);
        if ($decoded === false) {
            return false;
        }

        return base64_encode($decoded) === $value;
    }

    public static function empty(mixed $value): bool
    {
        return empty($value);
    }
}
