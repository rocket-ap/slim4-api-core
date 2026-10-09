# System Core

Unified core system for Slim 4 API projects.

## Directory Structure

```
system/
├── bootstrap/           # System initialization
│   ├── constants.php    # Global constants
│   ├── helpers.php      # Global helper functions
│   └── autoload.php     # PSR-4 autoloader
├── core/                # Core utilities
│   ├── Cookie.php       # Cookie management
│   ├── Mimes.php        # MIME type detection
│   ├── URI.php          # URI parsing
│   ├── UserAgent.php    # User agent parsing
│   ├── Request.php      # HTTP request handling
│   ├── Response.php     # HTTP response handling
│   └── Session.php      # Session management
├── services/            # System services
│   ├── Logger.php       # Logging service
│   ├── Cache.php        # Caching service
│   └── Config.php       # Configuration service
├── exceptions/          # Custom exceptions
│   ├── CoreException.php
│   └── SystemException.php
└── README.md
```

## Usage

### Bootstrap

Include the autoloader in your entry point:

```php
require __DIR__ . '/../system/bootstrap/autoload.php';
```

### Core Utilities

#### Cookie

```php
use System\Core\Cookie;

// Set a cookie
Cookie::set('username', 'john', ['expires' => time() + 3600]);

// Get a cookie
$username = Cookie::get('username');

// Check if exists
if (Cookie::has('username')) {
    // ...
}

// Delete a cookie
Cookie::delete('username');
```

#### Mimes

```php
use System\Core\Mimes;

// Get MIME type
$mime = Mimes::get('document.pdf'); // 'application/pdf'

// Check if is image
if (Mimes::isImage('photo.jpg')) {
    // ...
}

// Add custom MIME type
Mimes::add('webp', 'image/webp');
```

#### URI

```php
use System\Core\URI;

$uri = new URI();

// Get URI path
$path = $uri->getPath();

// Get segments
$segments = $uri->getSegments();
$first = $uri->getSegment(0);

// Get query parameters
$params = $uri->getQuery();
$id = $uri->getQueryParam('id');

// Get full URL
$url = $uri->getFullUrl();
```

#### UserAgent

```php
use System\Core\UserAgent;

$ua = new UserAgent();

// Get browser
$browser = $ua->getBrowser();

// Get platform
$platform = $ua->getPlatform();

// Get device type
$device = $ua->getDevice();

// Check device type
if ($ua->isMobile()) {
    // Mobile device
}
```

#### Request

```php
use System\Core\Request;

$request = new Request();

// Get request method
$method = $request->getMethod();

// Check request type
if ($request->isPost()) {
    $data = $request->getBody();
}

// Get client IP
$ip = $request->getClientIp();

// Get headers
$headers = $request->getHeaders();
```

#### Response

```php
use System\Core\Response;

$response = new Response();

// Send JSON
$response->json(['status' => 'success'], 200);

// Send HTML
$response->html('<h1>Hello</h1>', 200);

// Redirect
$response->redirect('https://example.com', 302);
```

#### Session

```php
use System\Core\Session;

// Set session
Session::set('user_id', 123);

// Get session
$userId = Session::get('user_id');

// Check if exists
if (Session::has('user_id')) {
    // ...
}

// Delete
Session::delete('user_id');

// Flush all
Session::flush();
```

## Global Helpers

Available global helper functions:

- `env($key, $default)` - Get environment variable
- `config($key, $default)` - Get configuration value
- `path($key, $default)` - Get path constant
- `getIpAddress()` - Get client IP address
- `now()` - Get current timestamp
- `uuid()` - Generate UUID
- `logger()` - Get logger instance
- `dd(...$vars)` - Die and dump
- `dump(...$vars)` - Dump variables
