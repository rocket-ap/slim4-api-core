<?php

namespace App\\Helpers;

/**
 * Array Helper
 * Static class for array manipulation
 * No require/include needed - PSR-4 autoloader handles it
 */
class Arr
{
    /**
     * Get value from nested array using dot notation
     * 
     * @param array $array
     * @param string $key (e.g., 'user.profile.name')
     * @param mixed $default
     * @return mixed
     */
    public static function get(array $array, string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $value = $array;

        foreach ($keys as $segment) {
            if (!is_array($value) || !array_key_exists($segment, $value)) {
                return $default;
            }
            $value = $value[$segment];
        }

        return $value;
    }

    /**
     * Set value in nested array using dot notation
     */
    public static function set(array &$array, string $key, mixed $value): array
    {
        $keys = explode('.', $key);
        $current = &$array;

        foreach ($keys as $segment) {
            if (!isset($current[$segment]) || !is_array($current[$segment])) {
                $current[$segment] = [];
            }
            $current = &$current[$segment];
        }

        $current = $value;

        return $array;
    }

    /**
     * Get only specified keys from array
     */
    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    /**
     * Get all except specified keys from array
     */
    public static function except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }

    /**
     * Flatten multi-dimensional array
     */
    public static function flatten(array $array, int $depth = INF, int $currentDepth = 0): array
    {
        $result = [];

        foreach ($array as $item) {
            if (is_array($item) && $currentDepth < $depth) {
                $result = array_merge($result, self::flatten($item, $depth, $currentDepth + 1));
            } else {
                $result[] = $item;
            }
        }

        return $result;
    }

    /**
     * Deep merge two arrays
     */
    public static function mergeDeep(array $array1, array $array2): array
    {
        $result = $array1;

        foreach ($array2 as $key => $value) {
            if (isset($result[$key]) && is_array($result[$key]) && is_array($value)) {
                $result[$key] = self::mergeDeep($result[$key], $value);
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }

    /**
     * Extract column from array of arrays/objects
     */
    public static function pluck(array $array, string $key): array
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

    /**
     * Get first element matching callback
     */
    public static function first(array $array, ?callable $callback = null, mixed $default = null): mixed
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

    /**
     * Get last element matching callback
     */
    public static function last(array $array, ?callable $callback = null, mixed $default = null): mixed
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

    /**
     * Filter array using callback
     */
    public static function where(array $array, callable $callback): array
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

    /**
     * Get random element(s) from array
     */
    public static function random(array $array, int $number = 1): mixed
    {
        if (empty($array)) {
            return null;
        }

        if ($number === 1) {
            return $array[array_rand($array)];
        }

        $keys = array_rand($array, $number);
        $result = [];
        foreach ((array) $keys as $key) {
            $result[] = $array[$key];
        }

        return $result;
    }

    /**
     * Add element if key doesn't exist
     */
    public static function add(array $array, string $key, mixed $value): array
    {
        if (!array_key_exists($key, $array)) {
            $array[$key] = $value;
        }

        return $array;
    }
}
