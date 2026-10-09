<?php

namespace App\Helpers;

class DateHelper
{
    public static function now(string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, time());
    }

    public static function format(int $timestamp, string $format = 'Y-m-d H:i:s'): string
    {
        return date($format, $timestamp);
    }

    public static function diff(string $date1, string $date2): int
    {
        return (int) abs(strtotime($date1) - strtotime($date2));
    }

    public static function ago(int $timestamp): string
    {
        $diff = time() - $timestamp;

        if ($diff < 60) {
            return $diff . ' seconds ago';
        }

        if ($diff < 3600) {
            return floor($diff / 60) . ' minutes ago';
        }

        if ($diff < 86400) {
            return floor($diff / 3600) . ' hours ago';
        }

        return floor($diff / 86400) . ' days ago';
    }
}
