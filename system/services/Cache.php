<?php

namespace System\Services;

/**
 * Cache Service
 * Simple file-based caching
 */
class Cache
{
    private string $cacheDir;

    public function __construct(string $cacheDir = '')
    {
        $this->cacheDir = $cacheDir ?: PATH_CACHE;
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Get cache file path
     */
    private function getPath(string $key): string
    {
        return $this->cacheDir . DS . md5($key) . '.cache';
    }

    /**
     * Put value in cache
     */
    public function put(string $key, mixed $value, int $ttl = 3600): void
    {
        $data = [
            'expires' => time() + $ttl,
            'value' => $value,
        ];
        file_put_contents($this->getPath($key), serialize($data));
    }

    /**
     * Get value from cache
     */
    public function get(string $key, mixed $default = null): mixed
    {
        $path = $this->getPath($key);

        if (!file_exists($path)) {
            return $default;
        }

        $data = unserialize(file_get_contents($path));

        if (time() > $data['expires']) {
            unlink($path);
            return $default;
        }

        return $data['value'];
    }

    /**
     * Check if key exists in cache
     */
    public function has(string $key): bool
    {
        return $this->get($key) !== null;
    }

    /**
     * Delete from cache
     */
    public function forget(string $key): void
    {
        $path = $this->getPath($key);
        if (file_exists($path)) {
            unlink($path);
        }
    }

    /**
     * Flush all cache
     */
    public function flush(): void
    {
        $files = glob($this->cacheDir . '/*.cache');
        foreach ($files as $file) {
            unlink($file);
        }
    }
}
