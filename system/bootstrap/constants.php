<?php

/**
 * System Constants
 * Core application constants defined here
 */

// Directory separators
defined('DS') || define('DS', DIRECTORY_SEPARATOR);

// Path constants
defined('PATH_ROOT') || define('PATH_ROOT', dirname(dirname(__DIR__)));
defined('PATH_SYSTEM') || define('PATH_SYSTEM', PATH_ROOT . DS . 'system');
defined('PATH_APP') || define('PATH_APP', PATH_ROOT . DS . 'app');
defined('PATH_CONFIG') || define('PATH_CONFIG', PATH_ROOT . DS . 'config');
defined('PATH_PUBLIC') || define('PATH_PUBLIC', PATH_ROOT . DS . 'public');
defined('PATH_STORAGE') || define('PATH_STORAGE', PATH_ROOT . DS . 'storage');
defined('PATH_BOOTSTRAP') || define('PATH_BOOTSTRAP', PATH_SYSTEM . DS . 'bootstrap');
defined('PATH_CORE') || define('PATH_CORE', PATH_SYSTEM . DS . 'core');
defined('PATH_SERVICES') || define('PATH_SERVICES', PATH_SYSTEM . DS . 'services');
defined('PATH_EXCEPTIONS') || define('PATH_EXCEPTIONS', PATH_SYSTEM . DS . 'exceptions');
defined('PATH_LOGS') || define('PATH_LOGS', PATH_STORAGE . DS . 'logs');
defined('PATH_CACHE') || define('PATH_CACHE', PATH_STORAGE . DS . 'cache');
defined('PATH_SESSIONS') || define('PATH_SESSIONS', PATH_STORAGE . DS . 'sessions');
defined('PATH_TEMP') || define('PATH_TEMP', PATH_STORAGE . DS . 'temp');

/**
 * Timing constants
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR') || define('HOUR', 3600);
defined('DAY') || define('DAY', 86400);
defined('WEEK') || define('WEEK', 604800);
defined('MONTH') || define('MONTH', 2592000);
defined('YEAR') || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/**
 * Common statuses
 */
define('STATUS_ACTIVE', 'active');
define('STATUS_INACTIVE', 'inactive');
define('STATUS_PENDING', 'pending');
define('STATUS_COMPLETED', 'completed');
define('STATUS_FAILED', 'failed');
define('STATUS_CANCELLED', 'cancelled');

/**
 * Roles
 */
define('ROLE_ADMIN', 'admin');
define('ROLE_RESELLER', 'reseller');
define('ROLE_CUSTOMER', 'customer');
define('ROLE_GUEST', 'guest');

/**
 * HTTP status codes
 */
define('HTTP_OK', 200);
define('HTTP_CREATED', 201);
define('HTTP_ACCEPTED', 202);
define('HTTP_NO_CONTENT', 204);
define('HTTP_BAD_REQUEST', 400);
define('HTTP_UNAUTHORIZED', 401);
define('HTTP_FORBIDDEN', 403);
define('HTTP_NOT_FOUND', 404);
define('HTTP_UNPROCESSABLE_ENTITY', 422);
define('HTTP_TOO_MANY_REQUESTS', 429);
define('HTTP_INTERNAL_SERVER_ERROR', 500);

/**
 * API defaults
 */
defined('API_VERSION') || define('API_VERSION', 'v1');
defined('API_PREFIX') || define('API_PREFIX', '/api');
define('DEFAULT_PAGINATION_LIMIT', 15);
define('LOG_CHANNEL_DEFAULT', 'default');
define('DEFAULT_LOCALE', 'en');
define('SUPPORTED_LOCALES', 'en,fa');
