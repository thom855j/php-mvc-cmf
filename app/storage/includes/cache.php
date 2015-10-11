<?php
/*
 * Bootstrap cache
 */
use WebSupportDK\PHPFilesystem\Cache;

if ($app->get('config')->cache->status):
	$cache = new Cache();
	$cache->setDir(APP_CACHE_DIR);
	$cache->setTime($app->get('config')->cache->time);
	$cache->setExt($app->get('config')->cache->ext);
	$cache->setIgnore($app->get('config')->cache->ignore);
endif;