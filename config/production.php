<?php
/*
 * Config for production
 */
var_dump(defined(DB_HOST));
die;
return (object) array(
		'app' => (object) array(
			'env' => 'production',
			'debug' => TRUE,
			'log' => TRUE,
			'url' => 'http://localhost/websupport/php-mvc-cmf/',
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
			'file' => 'storage/framework/sessions',
			'table' => 'sessions',
			'cookie' => uniqid(),
			'secure' => TRUE
		),
		'router' => (object) array(
			'default controller' => 'Pages',
			'default action' => 'index',
			'query string' => 'uri',
		),
		'database' => (object) array(
			'status' => FALSE,
			'driver' => 'mysql',
			'host' => defined('DB_HOST') ? DB_HOST : '127.0.0.1',
			'name' => defined('DB_DATABASE') ? DB_DATABASE : 'php-mvc-cmf',
			'username' => defined('DB_USERNAME') ? DB_USERNAME : 'root',
			'password' => defined('DB_PASSWORD') ? DB_PASSWORD : 'root',
			'charset' => 'utf-8',
			'collation' => '',
			'prefix' => ''
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

