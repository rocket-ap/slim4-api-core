<?php

namespace System\Core;

/**
 * HTTP Response Handler
 * Handles HTTP responses
 */
class Response
{
    private int $statusCode = 200;
    private array $headers = [];
    private mixed $body = '';

    public function __construct(int $statusCode = 200)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * Set response status code
     */
    public function setStatusCode(int $code): self
    {
        $this->statusCode = $code;
        http_response_code($code);
        return $this;
    }

    /**
     * Get response status code
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Set header
     */
    public function setHeader(string $name, string $value): self
    {
        $this->headers[$name] = $value;
        header($name . ': ' . $value);
        return $this;
    }

    /**
     * Get header
     */
    public function getHeader(string $name): ?string
    {
        return $this->headers[$name] ?? null;
    }

    /**
     * Get all headers
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Set response body
     */
    public function setBody(mixed $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get response body
     */
    public function getBody(): mixed
    {
        return $this->body;
    }

    /**
     * Send JSON response
     */
    public function json(array $data, int $statusCode = 200): self
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'application/json');
        $this->body = json_encode($data);
        echo $this->body;
        return $this;
    }

    /**
     * Send HTML response
     */
    public function html(string $content, int $statusCode = 200): self
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'text/html; charset=UTF-8');
        $this->body = $content;
        echo $this->body;
        return $this;
    }

    /**
     * Send text response
     */
    public function text(string $content, int $statusCode = 200): self
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Content-Type', 'text/plain; charset=UTF-8');
        $this->body = $content;
        echo $this->body;
        return $this;
    }

    /**
     * Redirect
     */
    public function redirect(string $url, int $statusCode = 302): void
    {
        $this->setStatusCode($statusCode);
        $this->setHeader('Location', $url);
        exit();
    }
}
