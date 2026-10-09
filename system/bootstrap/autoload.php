<?php

/**
 * System Autoloader
 * Loads system classes and helpers
 */

require_once __DIR__ . '/constants.php';
require_once __DIR__ . '/helpers.php';

/**
 * PSR-4 Autoloader for System namespace
 */
spl_autoload_register(function ($class) {
    $prefix = 'System\\';
    $base_dir = PATH_SYSTEM . DS;

    if (strpos($class, $prefix) !== 0) {
        return;
    }

    $relative_class = substr($class, strlen($prefix));
    $file = $base_dir . str_replace('\\', DS, $relative_class) . '.php';

    if (file_exists($file)) {
        require $file;
    }
});
