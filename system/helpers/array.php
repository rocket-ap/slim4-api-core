<?php

/**
 * Array Helpers
 * Helper functions for array manipulation
 */

if (!function_exists('array_get')) {
    function array_get(array $array, string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $value = $array;

        foreach ($keys as $k) {
            if (!is_array($value) || !array_key_exists($k, $value)) {
                return $default;
            }
            $value = $value[$k];
        }

        return $value;
    }
}

if (!function_exists('array_set')) {
    function array_set(array &$array, string $key, mixed $value): array
    {
        $keys = explode('.', $key);
        $current = &$array;

        foreach ($keys as $k) {
            if (!isset($current[$k]) || !is_array($current[$k])) {
                $current[$k] = [];
            }
            $current = &$current[$k];
        }

        $current = $value;

        return $array;
    }
}

if (!function_exists('array_only')) {
    function array_only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }
}

if (!function_exists('array_except')) {
    function array_except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }
}

if (!function_exists('array_flatten')) {
    function array_flatten(array $array, int $depth = INF, int $currentDepth = 0): array
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item) && $currentDepth < $depth) {
                $result = array_merge($result, array_flatten($item, $depth, $currentDepth + 1));
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }
}

if (!function_exists('array_merge_deep')) {
    function array_merge_deep(array $array1, array $array2): array
    {
        $result = $array1;

        foreach ($array2 as $key => $value) {
            if (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                $result[$key] = array_merge_deep($result[$key], $value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }
}

if (!function_exists('array_pluck')) {
    function array_pluck(array $array, string $key): array
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item) && array_key_exists($key, $item)) {
                $result[] = $item[$key];
            } elseif (is_object($item) && isset($item->$key)) {
                $result[] = $item->$key;
            }
        }

        return $result;
    }
}

if (!function_exists('array_first')) {
    function array_first(array $array, callable $callback = null, mixed $default = null): mixed
    {
        if ($callback === null) {
            return empty($array) ? $default : reset($array);
        }

        foreach ($array as $value) {
            if ($callback($value)) {
                return $value;
            }
        }

        return $default;
    }
}

if (!function_exists('array_last')) {
    function array_last(array $array, callable $callback = null, mixed $default = null): mixed
    {
        if ($callback === null) {
            return empty($array) ? $default : end($array);
        }

        $last = $default;

        foreach ($array as $value) {
            if ($callback($value)) {
                $last = $value;
            }
        }

        return $last;
    }
}

if (!function_exists('array_where')) {
    function array_where(array $array, callable $callback): array
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }
}

if (!function_exists('array_random')) {
    function array_random(array $array, int $number = 1): mixed
    {
        if ($number === 1) {
            return $array[array_rand($array)];
        }

        $keys = array_rand($array, $number);
        $result = [];

        foreach ((array)$keys as $key) {
            $result[] = $array[$key];
        }

        return $result;
    }
}

if (!function_exists('array_add')) {
    function array_add(array $array, string $key, mixed $value): array
    {
        if (!array_key_exists($key, $array)) {
            $array[$key] = $value;
        }

        return $array;
    }
}
