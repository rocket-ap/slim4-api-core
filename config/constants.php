<?php

namespace App\Helpers;

class Misc
{
    public static function blank(mixed $value): bool
    {
        return empty($value);
    }

    public static function filled(mixed $value): bool
    {
        return !empty($value);
    }

    public static function value(mixed $value): mixed
    {
        return $value;
    }

    public static function tap(mixed $value, callable $callback): mixed
    {
        $callback($value);
        return $value;
    }

    public static function optional(mixed $value): mixed
    {
        return $value;
    }

    public static function transform(mixed $value, callable $callback): mixed
    {
        return $callback($value);
    }
}
