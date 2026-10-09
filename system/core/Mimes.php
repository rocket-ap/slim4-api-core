<?php

namespace System\Core;

/**
 * MIME Type Detection
 * Maps file extensions to MIME types
 */
class Mimes
{
    private static array $mimes = [
        // Text
        'txt' => 'text/plain',
        'csv' => 'text/csv',
        'html' => 'text/html',
        'htm' => 'text/html',
        'xml' => 'application/xml',
        'json' => 'application/json',

        // Images
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
        'ico' => 'image/x-icon',
        'bmp' => 'image/bmp',
        'tiff' => 'image/tiff',

        // Audio
        'mp3' => 'audio/mpeg',
        'wav' => 'audio/wav',
        'ogg' => 'audio/ogg',
        'flac' => 'audio/flac',

        // Video
        'mp4' => 'video/mp4',
        'mpeg' => 'video/mpeg',
        'webm' => 'video/webm',
        'avi' => 'video/x-msvideo',
        'mov' => 'video/quicktime',

        // Documents
        'pdf' => 'application/pdf',
        'doc' => 'application/msword',
        'docx' => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        'xls' => 'application/vnd.ms-excel',
        'xlsx' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        'ppt' => 'application/vnd.ms-powerpoint',
        'pptx' => 'application/vnd.openxmlformats-officedocument.presentationml.presentation',

        // Archives
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'tar' => 'application/x-tar',
        'gz' => 'application/gzip',
        '7z' => 'application/x-7z-compressed',

        // Code
        'php' => 'text/x-php',
        'js' => 'text/javascript',
        'css' => 'text/css',
        'py' => 'text/x-python',
        'java' => 'text/x-java-source',
    ];

    /**
     * Get MIME type by file extension
     */
    public static function get(string $filename): string
    {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        return self::$mimes[$extension] ?? 'application/octet-stream';
    }

    /**
     * Check if a MIME type matches a pattern
     */
    public static function is(string $filename, string $type): bool
    {
        $mime = self::get($filename);
        return $mime === $type || strpos($mime, $type) === 0;
    }

    /**
     * Get all registered MIME types
     */
    public static function all(): array
    {
        return self::$mimes;
    }

    /**
     * Add custom MIME type
     */
    public static function add(string $extension, string $mime): void
    {
        self::$mimes[strtolower($extension)] = $mime;
    }

    /**
     * Check if extension is an image
     */
    public static function isImage(string $filename): bool
    {
        $mime = self::get($filename);
        return strpos($mime, 'image/') === 0;
    }

    /**
     * Check if extension is a video
     */
    public static function isVideo(string $filename): bool
    {
        $mime = self::get($filename);
        return strpos($mime, 'video/') === 0;
    }

    /**
     * Check if extension is audio
     */
    public static function isAudio(string $filename): bool
    {
        $mime = self::get($filename);
        return strpos($mime, 'audio/') === 0;
    }
}
