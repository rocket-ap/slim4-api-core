<?php

/**
 * File Helpers
 * Helper functions for file operations
 */

if (!function_exists('file_exists_check')) {
    function file_exists_check(string $path): bool
    {
        return file_exists($path);
    }
}

if (!function_exists('is_file_check')) {
    function is_file_check(string $path): bool
    {
        return is_file($path);
    }
}

if (!function_exists('is_directory_check')) {
    function is_directory_check(string $path): bool
    {
        return is_dir($path);
    }
}

if (!function_exists('is_readable_check')) {
    function is_readable_check(string $path): bool
    {
        return is_readable($path);
    }
}

if (!function_exists('is_writable_check')) {
    function is_writable_check(string $path): bool
    {
        return is_writable($path);
    }
}

if (!function_exists('get_file_contents')) {
    function get_file_contents(string $path): ?string
    {
        if (!file_exists($path)) {
            return null;
        }

        return file_get_contents($path);
    }
}

if (!function_exists('put_file_contents')) {
    function put_file_contents(string $path, string $contents, int $flags = 0): bool
    {
        $directory = dirname($path);

        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        return file_put_contents($path, $contents, $flags) !== false;
    }
}

if (!function_exists('append_file_contents')) {
    function append_file_contents(string $path, string $contents): bool
    {
        return put_file_contents($path, $contents, FILE_APPEND);
    }
}

if (!function_exists('delete_file')) {
    function delete_file(string $path): bool
    {
        if (file_exists($path) && is_file($path)) {
            return unlink($path);
        }

        return false;
    }
}

if (!function_exists('delete_directory')) {
    function delete_directory(string $path): bool
    {
        if (!is_dir($path)) {
            return false;
        }

        $files = scandir($path);
        if ($files === false) {
            return false;
        }

        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $path . DS . $file;
                if (is_dir($filePath)) {
                    delete_directory($filePath);
                } else {
                    unlink($filePath);
                }
            }
        }

        return rmdir($path);
    }
}

if (!function_exists('get_file_size')) {
    function get_file_size(string $path): ?int
    {
        if (!file_exists($path)) {
            return null;
        }

        return filesize($path);
    }
}

if (!function_exists('get_file_extension')) {
    function get_file_extension(string $filename): string
    {
        return strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    }
}

if (!function_exists('get_file_name')) {
    function get_file_name(string $path, bool $withExtension = true): string
    {
        if ($withExtension) {
            return basename($path);
        }

        return pathinfo($path, PATHINFO_FILENAME);
    }
}

if (!function_exists('get_directory_list')) {
    function get_directory_list(string $path, bool $recursive = false): ?array
    {
        if (!is_dir($path)) {
            return null;
        }

        $files = [];
        $items = scandir($path);

        if ($items === false) {
            return null;
        }

        foreach ($items as $item) {
            if ($item === '.' || $item === '..') {
                continue;
            }

            $filePath = $path . DS . $item;
            $files[] = $filePath;

            if ($recursive && is_dir($filePath)) {
                $subFiles = get_directory_list($filePath, true);
                if ($subFiles) {
                    $files = array_merge($files, $subFiles);
                }
            }
        }

        return $files;
    }
}

if (!function_exists('create_directory')) {
    function create_directory(string $path, int $mode = 0755): bool
    {
        if (!is_dir($path)) {
            return mkdir($path, $mode, true);
        }

        return true;
    }
}
