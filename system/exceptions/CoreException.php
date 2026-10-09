<?php

namespace System\Exceptions;

/**
 * Core Exception
 * Base exception for core system
 */
class CoreException extends \Exception
{
    public function __construct(string $message = '', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
