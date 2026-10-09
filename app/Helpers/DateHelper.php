<?php

namespace App\Helpers;

class Data
{
    public static function get(mixed $target, string $key, mixed $default = null): mixed
    {
        if (is_array($target)) {
            return Arr::get($target, $key, $default);
        }

        if (is_object($target)) {
            $segments = explode('.', $key);
            $value = $target;
            foreach ($segments as $segment) {
                if (is_object($value) && property_exists($value, $segment)) {
                    $value = $value->$segment;
                    continue;
                }

                if (is_array($value) && array_key_exists($segment, $value)) {
                    $value = $value[$segment];
                    continue;
                }

                return $default;
            }
            return $value;
        }

        return $default;
    }

    public static function set(array &$target, string $key, mixed $value): array
    {
        Arr::set($target, $key, $value);
        return $target;
    }

    public static function fill(array $target, string $key, mixed $value): array
    {
        if (!self::get($target, $key)) {
            Arr::set($target, $key, $value);
        }

        return $target;
    }

    public static function forget(array &$target, string $key): array
    {
        $segments = explode('.', $key);
        $ref = &$target;

        while (count($segments) > 1) {
            $segment = array_shift($segments);
            if (!is_array($ref) || !array_key_exists($segment, $ref)) {
                return $target;
            }
            $ref = &$ref[$segment];
        }

        $last = array_shift($segments);
        if (is_array($ref) && array_key_exists($last, $ref)) {
            unset($ref[$last]);
        }

        return $target;
    }
}
