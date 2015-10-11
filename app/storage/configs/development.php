<?php
/*
 * Config for development
 */
return (object) array(
		'site' => (object) array(
			'url' => 'http://localhost/websupport/php-mvc-cmf/',
			'lang' => 'EN-US',
			'locale' => 'en_US',
			'charset' => 'utf-8',
			'default theme' => 'default',
			'default page' => 'home'
		),
		'router' => (object) array(
			'default controller' => 'Pages',
			'default action' => 'index',
			'query string' => 'uri',
		),
		'db' => (object) array(
			'driver' => 'mysql',
			'host' => '127.0.0.1',
			'name' => 'php-mvc-cms',
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf-8',
			'collation' => '',
			'prefix' => ''
		),
		'cache' => (object) array(
			'status' => FALSE,
			'ext' => 'html',
			'ignore' => array(),
		),
		'debug' => (object) array(
			'status' => TRUE,
		)
);

