<?php
/*
 * Config for local development
 */

return array(
	'app' => array(
		'name' => 'Local app',
		'env' => 'local',
		'debug' => TRUE,
		'log' => FALSE,
		'url' => env('APP_URL', 'http://localhost/GitHub/WebSupport-DK/php-mvc-cmf/'),
		'key' => env('APP_KEY', 'se63UO9eSdaAx6e5Cq9PjQTIyW3yw6k3'),
		'locale' => 'en-US',
		'timezone' => 'UTC',
		'format' => 'H:i',
		'charset' => 'utf-8'
	),
	'auth' => array(
		'status' => TRUE,
		'table' => 'users'
	),
	'session' => array(
		'name' => 'session_id',
		'file' => 'framework/sessions',
		'table' => 'sessions',
		'expiry' => 1800,
		'cookie' => 'session',
		'secure' => TRUE
	),
	'router' => array(
		'storage' => 'app/Controllers',
		'controller' => 'Default',
		'action' => 'index',
		'queryString' => 'uri',
		'namespace' => 'App\\Controllers'
	),
	'database' => array(
		'status' => FALSE,
		'driver' => env('DB_DRIVER', 'mysql'),
		'host' => env('DB_HOST', '127.0.0.1'),
		'name' => env('DB_DATABSE','php-mvc-cmf'),
		'username' =>  env('DB_USERNAME', 'root'),
		'password' => env('DB_PASSWORD', 'root'),
		'charset' => 'utf-8',
		'collation' => '',
		'prefix' => env('DB_PREFIX','')
	),
	'view' => array(
		'storage' => 'views',
		'layouts' => array(),
		'templates' => array()
	),
	'cache' => array(
		'status' => FALSE,
		'storage' => 'framework/cache',
		'ext' => 'html',
		'ignore' => array(url() .'errors/code/404')
	),
	'compiler' => array(
		'status' => TRUE
	),
	'filesystem' => array(
		'upload' => 'uploads',
		'log' => 'storage/logs'
	),
	'mail' => array(
		'status' => TRUE,
		'driver' => env('MAIL_DRIVER', 'smtp'),
		'host' => env('MAIL_HOST', 'smtp.gmail.com'),
		'port' => env('MAIL_PORT', 587),
		'username' => env('MAIL_USERNAME', 'demo@gmail.com'),
		'password' => env('MAIL_PASSWORD', 'demo123'),
		'encryption' => env('MAIL_ENCRYPTION', 'tls')
	),
);

