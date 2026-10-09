<?php

namespace System\Core;

/**
 * HTTP Request Handler
 * Handles HTTP request data
 */
class Request
{
    private URI $uri;
    private UserAgent $userAgent;

    public function __construct()
    {
        $this->uri = new URI();
        $this->userAgent = new UserAgent();
    }

    /**
     * Get request method
     */
    public function getMethod(): string
    {
        return strtoupper($_SERVER['REQUEST_METHOD'] ?? 'GET');
    }

    /**
     * Check if request is GET
     */
    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }

    /**
     * Check if request is POST
     */
    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    /**
     * Check if request is PUT
     */
    public function isPut(): bool
    {
        return $this->getMethod() === 'PUT';
    }

    /**
     * Check if request is DELETE
     */
    public function isDelete(): bool
    {
        return $this->getMethod() === 'DELETE';
    }

    /**
     * Check if request is AJAX
     */
    public function isAjax(): bool
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && 
               strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';
    }

    /**
     * Check if request is secure (HTTPS)
     */
    public function isSecure(): bool
    {
        return !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off';
    }

    /**
     * Get URI object
     */
    public function getUri(): URI
    {
        return $this->uri;
    }

    /**
     * Get UserAgent object
     */
    public function getUserAgent(): UserAgent
    {
        return $this->userAgent;
    }

    /**
     * Get GET parameter
     */
    public function get(string $key, mixed $default = null): mixed
    {
        return $_GET[$key] ?? $default;
    }

    /**
     * Get POST parameter
     */
    public function post(string $key, mixed $default = null): mixed
    {
        return $_POST[$key] ?? $default;
    }

    /**
     * Get request body (for JSON)
     */
    public function getBody(): array
    {
        return json_decode(file_get_contents('php://input'), true) ?? [];
    }

    /**
     * Get header
     */
    public function getHeader(string $name): ?string
    {
        $name = 'HTTP_' . strtoupper(str_replace('-', '_', $name));
        return $_SERVER[$name] ?? null;
    }

    /**
     * Get all headers
     */
    public function getHeaders(): array
    {
        $headers = [];
        foreach ($_SERVER as $key => $value) {
            if (strpos($key, 'HTTP_') === 0) {
                $header = str_replace('HTTP_', '', $key);
                $header = str_replace('_', '-', strtolower($header));
                $headers[$header] = $value;
            }
        }
        return $headers;
    }

    /**
     * Get client IP address
     */
    public function getClientIp(): string
    {
        return getIpAddress();
    }
}
