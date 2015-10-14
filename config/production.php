<?php
/*
 * Config for local development
 */

return array(
	'app' => array(
		'env' => 'production',
		'debug' => FALSE,
		'log' => TRUE,
		'url' => defined('APP_URL') ? APP_URL : 'http://localhost/GitHub/WebSupport-DK/php-mvc-cmf/',
		'key' => defined('APP_KEY') ? APP_KEY : 'se63UO9eSdaAx6e5Cq9PjQTIyW3yw6k3',
		'locale' => 'en-US',
		'timezone' => 'UTC',
		'format' => 'H:i',
		'charset' => 'utf-8'
	),
	'auth' => array(
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
		'status' => TRUE,
		'driver' => defined('DB_CONNECTION') ? DB_CONNECTION : 'mysql',
		'host' => defined('DB_HOST') ? DB_HOST : '127.0.0.1',
		'name' => defined('DB_DATABASE') ? DB_DATABASE : 'php-mvc-cmf',
		'username' => defined('DB_USERNAME') ? DB_USERNAME : 'root',
		'password' => defined('DB_PASSWORD') ? DB_PASSWORD : 'root',
		'charset' => 'utf-8',
		'collation' => '',
		'prefix' => defined('DB_PREFIX') ? DB_PREFIX : '',
	),
	'view' => array(
		'storage' => 'views',
		'layouts' => array(),
		'templates' => array()
	),
	'cache' => array(
		'storage' => 'framework/cache',
		'status' => TRUE,
		'ext' => 'html',
		'ignore' => array(),
	),
	'filesystem' => array(
		'upload' => 'public/uploads',
		'log' => 'storage/logs'
	),
	'mail' => array(
		'driver' => defined('MAIL_DRIVER') ? MAIL_DRIVER : 'smtp',
		'host' => defined('MAIL_HOST') ? MAIL_HOST : 'smtp.gmail.com',
		'port' => defined('MAIL_PORT') ? MAIL_PORT : 587,
		'username' => defined('MAIL_USERNAME') ? MAIL_USERNAME : 'demo@gmail.com',
		'password' => defined('MAIL_PASSWORD') ? MAIL_PASSWORD : 'demo123',
		'encryption' => defined('MAIL_ENCRYPTION') ? MAIL_ENCRYPTION : 'tls'
	),
);

