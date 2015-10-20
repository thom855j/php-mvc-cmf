<?php
// Set absolute path
$app->set('__DIR__', realpath(__DIR__ . '/../../') . DIRECTORY_SEPARATOR);
define('BASE_PATH', $app->get('__DIR__'));
define('STORAGE_PATH', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

// Set env constants (commenly used)
foreach (parse_ini_file(BASE_PATH . '.env.ini') as $key => $value) {
	define($key, $value);
}

// Set config depending on env
$app->set('config', require BASE_PATH . 'config/' . APP_ENV . '.php');