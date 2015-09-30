<?php
/*
 * Bootstrap file for app
 */

// Project path
define('PATH_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// App path folders
define('PATH_APP', PATH_ROOT . 'app' . DIRECTORY_SEPARATOR);
define('PATH_APP_CONTROLLERS', PATH_APP . 'Controllers' . DIRECTORY_SEPARATOR);
define('PATH_APP_MODELS', PATH_APP . 'Models' . DIRECTORY_SEPARATOR);
define('PATH_APP_VIEWS', PATH_APP . 'views' . DIRECTORY_SEPARATOR);
define('PATH_APP_VIEWS_THEMES', PATH_APP_VIEWS . 'themes' . DIRECTORY_SEPARATOR);
define('PATH_APP_STORAGE', PATH_APP . 'storage' . DIRECTORY_SEPARATOR);

// Public path folders
define('PATH_PUBLIC', PATH_ROOT . 'public' . DIRECTORY_SEPARATOR);
define('PATH_PUBLIC_ASSETS', PATH_PUBLIC . 'assets' . DIRECTORY_SEPARATOR);
define('PATH_PUBLIC_UPLOADS', PATH_PUBLIC . 'uploads' . DIRECTORY_SEPARATOR);

// Vendor path
define('PATH_VENDOR', PATH_ROOT . 'vendor' . DIRECTORY_SEPARATOR);

// Env setup
if (APP_DEBUG === TRUE) {
	ini_set('display_errors', TRUE);
}
use WebSupportDK\PHPScrud\DB;

DB::load(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

