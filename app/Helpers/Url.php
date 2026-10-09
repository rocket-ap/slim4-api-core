<?php

namespace App\Helpers;

class Str
{
    public static function contains(string $haystack, string|array $needle): bool
    {
        if (is_array($needle)) {
            foreach ($needle as $value) {
                if (str_contains($haystack, $value)) {
                    return true;
                }
            }
            return false;
        }

        return str_contains($haystack, $needle);
    }

    public static function startsWith(string $haystack, string $needle): bool
    {
        return str_starts_with($haystack, $needle);
    }

    public static function endsWith(string $haystack, string $needle): bool
    {
        return str_ends_with($haystack, $needle);
    }

    public static function after(string $subject, string $search): string
    {
        if ($search === '') {
            return $subject;
        }

        $position = strpos($subject, $search);
        return $position === false ? $subject : substr($subject, $position + strlen($search));
    }

    public static function before(string $subject, string $search): string
    {
        if ($search === '') {
            return $subject;
        }

        $position = strpos($subject, $search);
        return $position === false ? $subject : substr($subject, 0, $position);
    }

    public static function slug(string $value, string $separator = '-'): string
    {
        $value = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $value);
        $value = preg_replace('/[^a-zA-Z0-9]+/', $separator, (string) $value);
        $value = trim((string) $value, $separator);

        return strtolower((string) $value);
    }

    public static function limit(string $value, int $limit = 100, string $end = '...'): string
    {
        if (strlen($value) <= $limit) {
            return $value;
        }

        return substr($value, 0, $limit - strlen($end)) . $end;
    }

    public static function random(int $length = 16): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $lengthCharacters = strlen($characters);
        $random = '';

        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[random_int(0, $lengthCharacters - 1)];
        }

        return $random;
    }

    public static function upper(string $value): string
    {
        return strtoupper($value);
    }

    public static function lower(string $value): string
    {
        return strtolower($value);
    }

    public static function title(string $value): string
    {
        return ucwords($value);
    }

    public static function ucFirst(string $value): string
    {
        return ucfirst($value);
    }

    public static function studly(string $value): string
    {
        $value = str_replace(['-', '_'], ' ', $value);
        $value = ucwords($value);
        return str_replace(' ', '', $value);
    }

    public static function camel(string $value): string
    {
        return lcfirst(self::studly($value));
    }

    public static function snake(string $value, string $delimiter = '_'): string
    {
        $value = preg_replace('/([a-z])([A-Z])/', '$1' . $delimiter . '$2', $value);
        $value = preg_replace('/[^A-Za-z0-9]+/', $delimiter, $value);
        return strtolower(trim((string) $value, $delimiter));
    }

    public static function finish(string $value, string $cap): string
    {
        if (str_ends_with($value, $cap)) {
            return $value;
        }

        return $value . $cap;
    }

    public static function start(string $value, string $prefix): string
    {
        if (str_starts_with($value, $prefix)) {
            return $value;
        }

        return $prefix . $value;
    }

    public static function replaceFirst(string $search, string $replace, string $subject): string
    {
        $position = strpos($subject, $search);
        if ($position === false) {
            return $subject;
        }

        return substr_replace($subject, $replace, $position, strlen($search));
    }

    public static function replaceLast(string $search, string $replace, string $subject): string
    {
        $position = strrpos($subject, $search);
        if ($position === false) {
            return $subject;
        }

        return substr_replace($subject, $replace, $position, strlen($search));
    }
}
