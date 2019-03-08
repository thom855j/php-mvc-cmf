<?php
/*
 * Set Cache
 */
use Datalaere\PHPFilesystem\Cache;
if ($app->get('config.cache.status')) {
	$app->set('Cache', new Cache());
	$app->get('Cache')->setDir(APP_CACHE_STORAGE);
	$app->get('Cache')->setTime($app->get('config.cache.time'));
	$app->get('Cache')->setExt($app->get('config.cache.ext'));
	$app->get('Cache')->setIgnore($app->get('config.cache.ignore'));
}
