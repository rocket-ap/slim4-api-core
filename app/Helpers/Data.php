<?php

namespace App\Helpers;

class File
{
    public static function exists(string $path): bool
    {
        return file_exists($path);
    }

    public static function isFile(string $path): bool
    {
        return is_file($path);
    }

    public static function isDir(string $path): bool
    {
        return is_dir($path);
    }

    public static function isReadable(string $path): bool
    {
        return is_readable($path);
    }

    public static function isWritable(string $path): bool
    {
        return is_writable($path);
    }

    public static function read(string $path): ?string
    {
        if (!self::exists($path)) {
            return null;
        }

        return file_get_contents($path);
    }

    public static function write(string $path, string $contents, int $flags = 0): bool
    {
        $dir = dirname($path);
        if (!is_dir($dir)) {
            mkdir($dir, 0775, true);
        }

        return file_put_contents($path, $contents, $flags) !== false;
    }

    public static function append(string $path, string $contents): bool
    {
        return self::write($path, $contents, FILE_APPEND);
    }

    public static function delete(string $path): bool
    {
        if (self::exists($path) && self::isFile($path)) {
            return unlink($path);
        }

        return false;
    }

    public static function deleteDir(string $path): bool
    {
        if (!self::isDir($path)) {
            return false;
        }

        $items = scandir($path);
        if ($items === false) {
            return false;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $path . DIRECTORY_SEPARATOR . $item;
            if (is_dir($fullPath)) {
                self::deleteDir($fullPath);
            } else {
                unlink($fullPath);
            }
        }

        return rmdir($path);
    }

    public static function size(string $path): ?int
    {
        if (!self::exists($path)) {
            return null;
        }

        return filesize($path);
    }

    public static function extension(string $filename): string
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }

    public static function name(string $path, bool $withExtension = true): string
    {
        if ($withExtension) {
            return basename($path);
        }

        return pathinfo($path, PATHINFO_FILENAME);
    }

    public static function list(string $path, bool $recursive = false): ?array
    {
        if (!self::isDir($path)) {
            return null;
        }

        $items = scandir($path);
        if ($items === false) {
            return null;
        }

        $result = [];
        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $fullPath = $path . DIRECTORY_SEPARATOR . $item;
            $result[] = $fullPath;

            if ($recursive && is_dir($fullPath)) {
                $subItems = self::list($fullPath, true);
                if ($subItems) {
                    $result = array_merge($result, $subItems);
                }
            }
        }

        return $result;
    }

    public static function createDir(string $path, int $mode = 0775): bool
    {
        if (self::isDir($path)) {
            return true;
        }

        return mkdir($path, $mode, true);
    }
}
