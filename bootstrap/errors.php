<?php
/*
 * Set PHP error options
 */

// Set custom error reporting
use App\Exceptions\Handler;

set_exception_handler(array(new Handler, 'exception'));

// Set debug env
if ($app->get('config.app.debug')) {
	error_reporting(E_ALL);
	ini_set('display_errors', TRUE);
	ini_set('display_startup_errors', TRUE);
} else {
	error_reporting(0);
	ini_set('display_errors', FALSE);
	ini_set('display_startup_errors', FALSE);
}

// Set error log reporting
if ($app->get('config.app.log')) {
	ini_set('log_errors', TRUE);
	ini_set('error_log', BASE_PATH . $app->get('config.filesystem.log') . DIRECTORY_SEPARATOR . 'php-error.log');
} else {
	ini_set('log_errors', FALSE);
}
