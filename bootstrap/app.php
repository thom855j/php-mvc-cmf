<?php
/*
  |--------------------------------------------------------------------------
  | Create The Application
  |--------------------------------------------------------------------------
  |
  | The first thing we will do is create a new  application instance
  | which serves as the "glue" for all the components, and is
  | the IoC container for the system binding all of the various parts.
  |
 */
use WebSupportDK\PHPMvcFramework\App;

// Start app
$app = App::load();
// Set absolute path
$app->set('__DIR__', realpath(__DIR__ . '/../') . DIRECTORY_SEPARATOR);
define('BASE_PATH', $app->get('__DIR__'));
define('STORAGE_PATH', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

// Set env constants (commenly used)
foreach (parse_ini_file(BASE_PATH . '.env.ini') as $key => $value) {
	define($key, $value);
}

// Set config depending on env
$app->set('config', require BASE_PATH . 'config/' . APP_ENV . '.php');


/*
  |--------------------------------------------------------------------------
  | App constants
  |--------------------------------------------------------------------------
  |
  | Set common app constants
  |
 */
define('APP_PUBLIC', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);
define('APP_UPLOAD', APP_PUBLIC . $app->get('config.filesystem.upload') . DIRECTORY_SEPARATOR);
define('APP_STORAGE', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

/*
 * URL paths
 */
define('APP_URL', $app->get('config.app.url'));
define('APP_ASSET', APP_URL . 'public/assets' . DIRECTORY_SEPARATOR);
define('APP_COMPONENT', APP_URL . 'public/components' . DIRECTORY_SEPARATOR);

/*
 * Resources path
 */
define('APP_RESOURCE', BASE_PATH . 'resources' . DIRECTORY_SEPARATOR);
define('APP_LANG', APP_RESOURCE . 'lang' . DIRECTORY_SEPARATOR);

/*
 * Storage paths
 */
define('APP_VIEW', APP_RESOURCE . $app->get('config.view.storage') . DIRECTORY_SEPARATOR);
define('APP_CACHE', APP_STORAGE . $app->get('config.cache.storage') . DIRECTORY_SEPARATOR);
define('APP_CONTROLLER', BASE_PATH . $app->get('config.router.storage') . DIRECTORY_SEPARATOR);



/*
  |--------------------------------------------------------------------------
  | PHP options
  |--------------------------------------------------------------------------
  |
  | Set common PHP options
  |
 */

/*
 * Set default time
 */
date_default_timezone_set($app->get('config.app.timezone'));

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

/*
 * Set PHP Session options
 */
session_save_path(STORAGE_PATH . $app->get('config.session.file') . DIRECTORY_SEPARATOR);
if (session_id() == '') {
	session_cache_limiter(false);
	session_set_cookie_params(0);
	session_start();
}

/*
  |--------------------------------------------------------------------------
  | Language selection
  |--------------------------------------------------------------------------
  |
  | To make a multilingual app we need to setup  language
  |
 */
use WebSupportDK\PHPSecurity\Cookie;

define('APP_LOCALE', $app->get('config.app.locale'));
define('APP_CHARSET', $app->get('config.app.charset'));

// Set session locale
if (!Cookie::exists('locale')) {
	Cookie::set('locale', APP_LOCALE, $app->get('config.session.expiry'));
}

$app->set('messages', require APP_LANG . APP_LOCALE . '/messages.php');



/*
  |--------------------------------------------------------------------------
  | Basic helper functions
  |--------------------------------------------------------------------------
  |
  | Common functions for easier development (you can add your own here)
  |
 */

function locale()
{

	return APP_LOCALE;
}

function trans($string)
{
	global $app;
	return $app->get($string);
}

function charset()
{
	return APP_CHARSET;
}

function vd($object)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
}

function asset($path)
{
	return APP_ASSET . $path;
}

function pr($object)
{
	echo '<pre>';
	print_r($object);
	echo '</pre>';
}

function e($string)
{
	echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function inc($path)
{
	include_once $path . '.php';
}

function req($path)
{
	require_once $path . '.php';
}

function rutime($ru, $rus, $index)
{
	return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
}
/*
  |--------------------------------------------------------------------------
  | Bind Important Interfaces
  |--------------------------------------------------------------------------
  |
  | Next, we need to bind some important interfaces into the container so
  | we will be able to resolve them when needed.
  |
 */

/*
 * Set View
 */

$app->set('View', WebSupportDK\PHPMvcFramework\View::load());
$app->get('View')->setTemplatePath(APP_VIEW);
$app->get('View')->setFeedbackFile(APP_VIEW . '/layouts/feedback');

/*
 * Set Cache
 */
if ($app->get('config.cache.status')) {
	$app->set('Cache', new WebSupportDK\PHPFilesystem\Cache());
	$app->get('Cache')->setDir(APP_CACHE);
	$app->get('Cache')->setTime($app->get('config.cache.time'));
	$app->get('Cache')->setExt($app->get('config.cache.ignore'));
	$app->get('Cache')->setIgnore($app->get('config.cache.ignore'));
}

/*
 * Set database
 */
if ($app->get('config.cache.status')) {
	$app->set('DB', WebSupportDK\PHPScrud\DB::load(
			$app->get('config.database.driver'), $app->get('config.database.host'), $app->get('config.database.name'), $app->get('config.database.username'), $app->get('config.database.password')
	));
}

/*
 * Set Router
 */
$app->set('Router', new WebSupportDK\PHPMvcFramework\Router);
$app->get('Router')->setControllersPath(BASE_PATH . 'app/Controllers' . DIRECTORY_SEPARATOR);
$app->get('Router')->setDefaultController($app->get('config.router.controller'));
$app->get('Router')->setDefaultAction($app->get('config.router.action'));
$app->get('Router')->setQueryString($app->get('config.router.queryString'));
$app->get('Router')->setNamespace($app->get('config.router.namespace'));

// Return app
return $app;
