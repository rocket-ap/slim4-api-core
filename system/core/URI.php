<?php

namespace System\Core;

/**
 * URI Parser
 * Parses and manipulates URIs
 */
class URI
{
    private string $uri;
    private array $segments = [];
    private array $query = [];

    public function __construct(string $uri = '')
    {
        $this->uri = $uri ?: $_SERVER['REQUEST_URI'] ?? '/';
        $this->parse();
    }

    /**
     * Parse URI into components
     */
    private function parse(): void
    {
        // Remove query string
        $path = parse_url($this->uri, PHP_URL_PATH) ?? '/';

        // Parse query string
        $queryString = parse_url($this->uri, PHP_URL_QUERY) ?? '';
        parse_str($queryString, $this->query);

        // Remove leading/trailing slashes and split into segments
        $this->segments = array_filter(explode('/', trim($path, '/')));
    }

    /**
     * Get full URI
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * Get URI path
     */
    public function getPath(): string
    {
        return parse_url($this->uri, PHP_URL_PATH) ?? '/';
    }

    /**
     * Get all segments
     */
    public function getSegments(): array
    {
        return $this->segments;
    }

    /**
     * Get a specific segment
     */
    public function getSegment(int $index, mixed $default = null): mixed
    {
        return $this->segments[$index] ?? $default;
    }

    /**
     * Get query parameters
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * Get a query parameter
     */
    public function getQueryParam(string $key, mixed $default = null): mixed
    {
        return $this->query[$key] ?? $default;
    }

    /**
     * Get scheme (http or https)
     */
    public function getScheme(): string
    {
        return $_SERVER['REQUEST_SCHEME'] ?? 'http';
    }

    /**
     * Get host
     */
    public function getHost(): string
    {
        return $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? 'localhost';
    }

    /**
     * Get full URL
     */
    public function getFullUrl(): string
    {
        return $this->getScheme() . '://' . $this->getHost() . $this->uri;
    }

    /**
     * Check if segment exists
     */
    public function hasSegment(int $index): bool
    {
        return isset($this->segments[$index]);
    }
}
