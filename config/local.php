<?php
/*
 * Config for local development
 */

return (object) array(
		'app' => (object) array(
			'env' => 'local',
			'debug' => TRUE,
			'log' => TRUE,
			'url' => 'http://localhost/GitHub/WebSupport-DK/php-mvc-cmf/',
			'key' => defined('APP_KEY') ? APP_KEY : 'se63UO9eSdaAx6e5Cq9PjQTIyW3yw6k3',
			'locale' => 'en_US',
			'charset' => 'utf-8',
			'default theme' => 'default',
			'default page' => 'home'
		),
		'auth' => (object) array(
			'table' => 'users'
		),
		'session' => (object) array(
			'file' => 'framework/sessions',
			'table' => 'sessions',
			'expiry' => 1800,
			'cookie' => uniqid(),
			'secure' => TRUE
		),
		'router' => (object) array(
			'default controller' => 'Pages',
			'default action' => 'index',
			'query string' => 'uri',
			'namespace' => 'App\\Controllers'
		),
		'database' => (object) array(
			'status' => TRUE,
			'driver' => 'mysql',
			'host' => defined('DB_HOST') ? DB_HOST : '127.0.0.1',
			'name' => defined('DB_DATABASE') ? DB_DATABASE : 'php-mvc-cmf',
			'username' => defined('DB_USERNAME') ? DB_USERNAME : 'root',
			'password' => defined('DB_PASSWORD') ? DB_PASSWORD : 'root',
			'charset' => 'utf-8',
			'collation' => '',
			'prefix' => ''
		),
		'view' => (object) array(
			'storage' => 'resources/views',
			'layouts' => array('layouts/header', 'index', 'layouts/footer'),
			'templates' => array('auth/login','new')
		),
		'cache' => (object) array(
			'status' => FALSE,
			'ext' => 'html',
			'ignore' => array(),
		),
		'filesystem' => (object) array(
			'upload' => 'public/uploads',
			'log' => 'storage/logs'
		),
		'mail' => (object) array(
			'driver' => defined('MAIL_DRIVER') ? MAIL_DRIVER : 'smtp',
			'host' => defined('MAIL_HOST') ? MAIL_HOST : 'smtp.gmail.com',
			'port' => defined('MAIL_PORT') ? MAIL_PORT : 587,
			'username' => defined('MAIL_USERNAME') ? MAIL_USERNAME : 'demo@gmail.com',
			'password' => defined('MAIL_PASSWORD') ? MAIL_PASSWORD : 'demo123',
			'encryption' => defined('MAIL_ENCRYPTION') ? MAIL_ENCRYPTION : 'tls'
		),
);

