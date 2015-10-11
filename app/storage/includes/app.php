<?php
/**
 * Bootstrap config
 */
use WebSupportDK\PHPMvcFramework\App;

$app = App::load();
$app->set('mode', file_get_contents(ABSPATH . '.env'));
$app->set('config', require_once APP_CONFIG_DIR. "{$app->get('mode')}.php");

