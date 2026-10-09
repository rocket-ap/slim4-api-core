<?php

namespace System\Services;

/**
 * Logger Service
 * Handles application logging
 */
class Logger
{
    private array $config = [];
    private string $logFile;

    public function __construct(array $config = [])
    {
        $this->config = $config;
        $this->initializeLogFile();
    }

    /**
     * Initialize log file
     */
    private function initializeLogFile(): void
    {
        $channelConfig = $this->config['channels']['default'] ?? [];
        $this->logFile = $channelConfig['path'] ?? (PATH_LOGS . DS . 'app.log');

        if (!is_dir(dirname($this->logFile))) {
            mkdir(dirname($this->logFile), 0755, true);
        }
    }

    /**
     * Log message
     */
    public function log(string $level, string $message, array $context = []): void
    {
        $timestamp = date('Y-m-d H:i:s');
        $logMessage = "[$timestamp] [$level] $message";

        if (!empty($context)) {
            $logMessage .= ' ' . json_encode($context);
        }

        file_put_contents($this->logFile, $logMessage . PHP_EOL, FILE_APPEND);
    }

    public function info(string $message, array $context = []): void
    {
        $this->log('INFO', $message, $context);
    }

    public function error(string $message, array $context = []): void
    {
        $this->log('ERROR', $message, $context);
    }

    public function warning(string $message, array $context = []): void
    {
        $this->log('WARNING', $message, $context);
    }

    public function debug(string $message, array $context = []): void
    {
        $this->log('DEBUG', $message, $context);
    }
}
