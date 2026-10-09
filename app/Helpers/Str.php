<?php

namespace App\Helpers;

class Arr
{
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

    public static function only(array $array, array $keys): array
    {
        return array_intersect_key($array, array_flip($keys));
    }

    public static function except(array $array, array $keys): array
    {
        return array_diff_key($array, array_flip($keys));
    }

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

    public static function where(array $array, callable $callback): array
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

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

    public static function add(array $array, string $key, mixed $value): array
    {
        if (!array_key_exists($key, $array)) {
            $array[$key] = $value;
        }

        return $array;
    }
}
