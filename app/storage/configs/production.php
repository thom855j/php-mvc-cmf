<?php
/*
 * Config for development
 */
return array(
	'site' => array(
		'url' => 'http://localhost/websupport/php-mvc-cmf/',
		'lang' => 'EN-US',
		'locale' => 'en_US',
		'default theme' => 'default',
		'default page' => 'home'
	),
	'router' => array(
		'default controller' => 'Pages',
		'default action' => 'index',
		'query string' => 'uri',
	),
	'db' => array(
		'driver' => 'mysql',
		'host' => '127.0.0.1',
		'name' => 'php-mvc-cms',
		'username' => 'root',
		'password' => 'root',
		'charset' => 'utf-8',
		'collation' => '',
		'prefix' => ''
	),
	'cache' => array(
		'status' => FALSE,
		'ext' => 'html',
		'ignore' => array(),
	),
	'debug' => array(
		'status' => TRUE,
	)
);

