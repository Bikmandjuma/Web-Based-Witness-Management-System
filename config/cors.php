<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

    // 'paths' => ['api/*'],
    // 'allowed_origins' => ['*'],
    // 'supports_credentials' => true, // Allow credentials (e.g., cookies, tokens)
    // 'allowed_origins_patterns' => [], // Leave empty unless using dynamic subdomains
    // 'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept', 'Origin'],
    // 'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    // 'exposed_headers' => ['Authorization'], // Optional: expose custom headers
    // 'max_age' => 3600, // Cache preflight response for 1 hour

    'paths' => ['api/*'],
    'allowed_origins' => ['http://localhost:5500'], // exact origin for credentials
    'supports_credentials' => true,
    'allowed_headers' => ['Content-Type', 'X-Requested-With', 'Authorization', 'Accept', 'Origin'],
    'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'],
    'exposed_headers' => ['Authorization'],
    'max_age' => 3600,



];
