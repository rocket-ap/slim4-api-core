<?php

namespace System\Core;

/**
 * User Agent Parser
 * Parses and identifies user agent information
 */
class UserAgent
{
    private string $userAgent;
    private string $browser = 'Unknown';
    private string $platform = 'Unknown';
    private string $device = 'Unknown';

    public function __construct(string $userAgent = '')
    {
        $this->userAgent = $userAgent ?: $_SERVER['HTTP_USER_AGENT'] ?? '';
        $this->parse();
    }

    /**
     * Parse user agent string
     */
    private function parse(): void
    {
        $this->parseBrowser();
        $this->parsePlatform();
        $this->parseDevice();
    }

    /**
     * Parse browser information
     */
    private function parseBrowser(): void
    {
        $browsers = [
            'Chrome' => 'Chrome',
            'Firefox' => 'Firefox',
            'Safari' => 'Safari',
            'Edge' => 'Edge',
            'Opera' => 'Opera',
            'IE' => 'Internet Explorer',
        ];

        foreach ($browsers as $pattern => $name) {
            if (stripos($this->userAgent, $pattern) !== false) {
                $this->browser = $name;
                return;
            }
        }
    }

    /**
     * Parse platform/OS
     */
    private function parsePlatform(): void
    {
        $platforms = [
            'Windows' => 'Windows',
            'Mac' => 'Mac',
            'Linux' => 'Linux',
            'iPhone' => 'iOS',
            'iPad' => 'iOS',
            'Android' => 'Android',
        ];

        foreach ($platforms as $pattern => $name) {
            if (stripos($this->userAgent, $pattern) !== false) {
                $this->platform = $name;
                return;
            }
        }
    }

    /**
     * Parse device type
     */
    private function parseDevice(): void
    {
        if (preg_match('/(mobile|android|iphone|ipad|tablet)/i', $this->userAgent)) {
            $this->device = preg_match('/(tablet|ipad)/i', $this->userAgent) ? 'Tablet' : 'Mobile';
        } else {
            $this->device = 'Desktop';
        }
    }

    /**
     * Get browser name
     */
    public function getBrowser(): string
    {
        return $this->browser;
    }

    /**
     * Get platform/OS
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }

    /**
     * Get device type
     */
    public function getDevice(): string
    {
        return $this->device;
    }

    /**
     * Check if mobile
     */
    public function isMobile(): bool
    {
        return $this->device === 'Mobile';
    }

    /**
     * Check if tablet
     */
    public function isTablet(): bool
    {
        return $this->device === 'Tablet';
    }

    /**
     * Check if desktop
     */
    public function isDesktop(): bool
    {
        return $this->device === 'Desktop';
    }

    /**
     * Get full user agent string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }
}
