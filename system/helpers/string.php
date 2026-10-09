<?php

/**
 * String Helpers
 * Helper functions for string manipulation
 */

if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string|array $needle): bool
    {
        if (is_array($needle)) {
            foreach ($needle as $n) {
                if (str_contains($haystack, $n)) {
                    return true;
                }
            }
            return false;
        }

        return strpos($haystack, $needle) !== false;
    }
}

if (!function_exists('str_starts_with')) {
    function str_starts_with(string $haystack, string $needle): bool
    {
        return strpos($haystack, $needle) === 0;
    }
}

if (!function_exists('str_ends_with')) {
    function str_ends_with(string $haystack, string $needle): bool
    {
        return substr($haystack, -strlen($needle)) === $needle;
    }
}

if (!function_exists('str_after')) {
    function str_after(string $subject, string $search): string
    {
        return $search === '' ? $subject : substr($subject, strpos($subject, $search) + strlen($search));
    }
}

if (!function_exists('str_before')) {
    function str_before(string $subject, string $search): string
    {
        return $search === '' ? $subject : substr($subject, 0, strpos($subject, $search));
    }
}

if (!function_exists('str_slug')) {
    function str_slug(string $title, string $separator = '-', string $language = 'en'): string
    {
        $title = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $title);
        $title = preg_replace('/[^a-z0-9]+/i', $separator, $title);
        $title = trim($title, $separator);
        $title = strtolower($title);

        return preg_replace('/' . preg_quote($separator) . '{2,}/', $separator, $title);
    }
}

if (!function_exists('str_limit')) {
    function str_limit(string $value, int $limit = 100, string $end = '...'): string
    {
        if (strlen($value) <= $limit) {
            return $value;
        }

        return substr($value, 0, $limit - strlen($end)) . $end;
    }
}

if (!function_exists('str_random')) {
    function str_random(int $length = 16): string
    {
        return random_string($length);
    }
}

if (!function_exists('str_upper')) {
    function str_upper(string $value): string
    {
        return strtoupper($value);
    }
}

if (!function_exists('str_lower')) {
    function str_lower(string $value): string
    {
        return strtolower($value);
    }
}

if (!function_exists('str_title')) {
    function str_title(string $value): string
    {
        return ucwords($value);
    }
}

if (!function_exists('str_ucfirst')) {
    function str_ucfirst(string $value): string
    {
        return ucfirst($value);
    }
}

if (!function_exists('str_studly')) {
    function str_studly(string $value): string
    {
        $value = str_replace(['-', '_'], ' ', $value);
        $value = ucwords($value);
        return str_replace(' ', '', $value);
    }
}

if (!function_exists('str_camel')) {
    function str_camel(string $value): string
    {
        return lcfirst(str_studly($value));
    }
}

if (!function_exists('str_snake')) {
    function str_snake(string $value, string $delimiter = '_'): string
    {
        $value = preg_replace('/([a-z])([A-Z])/', '$1' . $delimiter . '$2', $value);
        return strtolower(preg_replace('/([a-zA-Z0-9])([A-Z])/', '$1' . $delimiter . '$2', $value));
    }
}

if (!function_exists('str_finish')) {
    function str_finish(string $value, string $cap): string
    {
        $quoted = preg_quote($cap, '/');
        return preg_replace('/' . $quoted . '?$/', $cap, $value);
    }
}

if (!function_exists('str_start')) {
    function str_start(string $value, string $prefix): string
    {
        $quoted = preg_quote($prefix, '/');
        return $prefix . preg_replace('/^' . $quoted . '/', '', $value);
    }
}

if (!function_exists('str_replace_first')) {
    function str_replace_first(string $search, string $replace, string $subject): string
    {
        $pos = strpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}

if (!function_exists('str_replace_last')) {
    function str_replace_last(string $search, string $replace, string $subject): string
    {
        $pos = strrpos($subject, $search);
        if ($pos !== false) {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}
