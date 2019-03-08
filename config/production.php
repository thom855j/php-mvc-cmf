<?php
/*
 * Config for local development
 */

return array(
    'app' => array(
        'name' => 'Production app',
        'env' => 'production',
        'debug' => false,
        'log' => true,
        'url' => env('APP_URL', 'http://localhost/GitHub/WebSupport-DK/php-mvc-cmf/'),
        'key' => env('APP_KEY', 'se63UO9eSdaAx6e5Cq9PjQTIyW3yw6k3'),
        'locale' => 'en-US',
        'timezone' => 'UTC',
        'format' => 'H:i',
        'charset' => 'utf-8'
    ),
    'auth' => array(
        'status' => true,
        'table' => 'users'
    ),
    'session' => array(
        'name' => 'session_id',
        'file' => 'framework/sessions',
        'table' => 'sessions',
        'expiry' => 1800,
        'cookie' => 'session',
        'secure' => true
    ),
    'router' => array(
        'storage' => 'app/Http/Controllers',
        'controller' => 'Default',
        'action' => 'index',
        'queryString' => 'uri',
        'namespace' => 'App\\Http\\Controllers'
    ),
    'database' => array(
        'status' => false,
        'driver' => env('DB_DRIVER', 'mysql'),
        'host' => env('DB_HOST', '127.0.0.1'),
        'name' => env('DB_DATABSE', 'php-mvc-cmf'),
        'username' =>  env('DB_USERNAME', 'root'),
        'password' => env('DB_PASSWORD', 'root'),
        'charset' => 'utf-8',
        'collation' => '',
        'prefix' => env('DB_PREFIX', '')
    ),
    'view' => array(
        'storage' => 'views',
        'layouts' => array(),
        'templates' => array()
    ),
    'cache' => array(
        'status' => env('APP_CACHE', true),
        'storage' => 'framework/cache',
        'ext' => 'html',
        'ignore' => array(url() .'errors/code/404')
    ),
    'compiler' => array(
        'status' => env('APP_COMPILER', true),
    ),
    'filesystem' => array(
        'upload' => 'uploads',
        'log' => 'storage/logs'
    ),
    'mail' => array(
        'status' => true,
        'driver' => env('MAIL_DRIVER', 'smtp'),
        'host' => env('MAIL_HOST', 'smtp.gmail.com'),
        'port' => env('MAIL_PORT', 587),
        'username' => env('MAIL_USERNAME', 'demo@gmail.com'),
        'password' => env('MAIL_PASSWORD', 'demo123'),
        'encryption' => env('MAIL_ENCRYPTION', 'tls')
    ),
);
