<?php
/*
 * Load app
 */
use Datalaere\PHPMvcFramework\App;

// Start app
$app = App::load();

// Get or set something to/from app
if (!function_exists('app')) { 

	function app($name, $value = null)
	{
		global $app;
		if(!is_null($value))
		{
			return $app->set($name, $value);
		}
		return $app->get($name);
	}
}

// Set env varibale from constant or use default string
if (!function_exists('env')) { 

	function env($constant, $string)
	{
	  return defined($constant) ? constant($constant) : $string;
	}
}

// Get a view from the resources folder
if (!function_exists('env')) { 

	function view($string)
	{
		req(APP_VIEW . $string);
	}
}

// Get something from config
if (!function_exists('config')) { 
	function config($string)
	{
		global $app;
		return $app->get("config.{$string}");
	}
}

// Get uploaded file
if (!function_exists('uploaded_file')) { 

	function uploaded_file($string)
	{
		return APP_UPLOAD . $string;
	}	
}

// Return locale lang
if (!function_exists('locale')) { 

	function locale()
	{
		return APP_LOCALE;
	}
}

// Translate a string
if (!function_exists('trans')) { 
	
	function trans($string)
	{
		global $app;
		return $app->get($string);
	}
}

// Return app charset
if (!function_exists('charset')) { 
	
	function charset()
	{
		return APP_CHARSET;
	}
}

// Die and dump object
if (!function_exists('dd')) { 
	
	function dd($object)
	{
		echo '<pre>';
		var_dump($object);
		echo '</pre>';
		die;
	}
}


// Redirect http errors
if (!function_exists('http_error_handler')) { 

	function http_error_handler(){
	  /*
	  * Custom header errors handeling
	  */

	  switch (http_response_code())
	  {
	  case 404:
	    return redirect('errors/code/404/');
	    break;

	    case 500:
	    return redirect('errors/code/500');
	    break;

	  default:
	    break;
  		}
	}
}

// Return last visited url
if (!function_exists('http_referer')) { 

	function http_referer()
	{
		return Datalaere\PHPHttp\Url::getPrevious();
	}
}

// Redirect to string
if (!function_exists('redirect')) { 

	function redirect($string = null)
	{
		return Datalaere\PHPHttp\Url::redirect(Datalaere\PHPHttp\Url::getRoot('public') . $string);
	}
}

// Redirect back
if (!function_exists('back')) { 

	function back()
	{
		return redirect(http_referer());
	}
}

// Return current url
if (!function_exists('back')) { 

	function current_url(){
		return Datalaere\PHPHttp\Url::get();
	}
}

// Return current url (optionally with a path)
if (!function_exists('url')) { 
	
	function url($path = null){
		return Datalaere\PHPHttp\Url::getRoot('public') . $path;
	}
}

// Get an asset from the public url
if (!function_exists('asset')) { 

	function asset($path)
	{
		return APP_ASSET . $path;
	}
}

// Get a component from public url
if (!function_exists('component')) { 

	function component($path)
	{
		return APP_COMPONENT . $path;
	}
}


// print_r an object
if (!function_exists('pr')) { 

	function pr($object)
	{
		echo '<pre>';
		print_r($object);
		echo '</pre>';
		die;
	}
}

// Echo and escape string
if (!function_exists('e')) { 

	function e($string)
	{
		echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}

// Include a file
if (!function_exists('inc')) { 

	function inc($path)
	{
		include_once $path . '.php';
	}
}

// Require a file
if (!function_exists('req')) { 

	function req($path)
	{
		require_once $path . '.php';
	}
}

// Output runtime of app
if (!function_exists('rutime')) { 

	function rutime($ru, $rus, $index)
	{
		return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
	}
}

// Return storage page
if (!function_exists('storage')) { 

	function storage($path)
	{
		return APP_STORAGE . $path;
	}
}

if (!function_exists('csrf_token')) { 
	
	function csrf_token($key){
		return Datalaere\PHPSecurity\Token::generate($key);
	}
}

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
/*
 * App paths
 */
define('APP_PUBLIC', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);
define('APP_UPLOAD', APP_PUBLIC . $app->get('config.filesystem.upload') . DIRECTORY_SEPARATOR);
define('APP_STORAGE', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

/*
 * URL paths
 */
define('APP_ASSET', $app->get('config.app.url') . 'public/assets' . DIRECTORY_SEPARATOR);
define('APP_COMPONENT', $app->get('config.app.url') . 'public/components' . DIRECTORY_SEPARATOR);

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
 * PHP ini paths
 */
ini_set('upload_tmp_dir', APP_STORAGE . 'framework/app' . DIRECTORY_SEPARATOR); 
/*
 * Custom constants
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
	session_name($app->get('config.session.name'));
	session_start();
}

/*
 * Set default time
 */
date_default_timezone_set($app->get('config.app.timezone'));
use Datalaere\PHPSecurity\Cookie;
use Datalaere\PHPSecurity\Session;
define('APP_LOCALE', $app->get('config.app.locale'));
define('APP_CHARSET', $app->get('config.app.charset'));

// Set default locale
Session::set('locale',APP_LOCALE);

// Set session locale
if (Cookie::exists('locale')) {
	$app->set('messages', require APP_LANG . Cookie::get('locale') . '/messages.php');
} else {
	$app->set('messages', require APP_LANG . Session::get('locale') . '/messages.php');
}

/*
 * Set View
 */
use Datalaere\PHPMvcFramework\View;
$app->set('View', View::load());
$app->get('View')->setTemplatePath(APP_VIEW);
$app->get('View')->setFeedbackFile(APP_VIEW . 'layouts/feedback');

/*
 * Set Cache
 */
use Datalaere\PHPFilesystem\Cache;
if ($app->get('config.cache.status')) {
	$app->set('Cache', new Cache());
	$app->get('Cache')->setDir(APP_CACHE);
	$app->get('Cache')->setTime($app->get('config.cache.time'));
	$app->get('Cache')->setExt($app->get('config.cache.ext'));
	$app->get('Cache')->setIgnore($app->get('config.cache.ignore'));
}

/*
 * Set database
 */
use Datalaere\PHPScrud\DB;
if ($app->get('config.database.status')) {
	$app->set('DB', DB::load(
		$app->get('config.database.driver'), 
		$app->get('config.database.host'), 
		$app->get('config.database.name'), 
		$app->get('config.database.username'), 
		$app->get('config.database.password')

	));
}

/*
 * Set auth
 */
 use Datalaere\PHPAuthFramework\Auth;
 if($app->get('config.auth.status')){
 	$app->set('Auth', Auth::load());
 	$app->get('Auth')->setAttribute('db',$app->get('DB'));
 	$app->get('Auth')->setAttribute('token',$app->get('config.app.key'));
 	$app->get('Auth')->setAttribute('sessionName',$app->get('config.session.name'));
 }

/*
 * Set mailer
 */

// Get mail driver
use PHPMailer\PHPMailer\PHPMailer;

if ($app->get('config.mail.status')) {
// Set driver
$app->set('Mailer', new PHPMailer);
if(!is_null($app->get('config.mail.driver'))){
	$app->get('Mailer')->isSMTP();
}
$app->get('Mailer')->CharSet = $app->get('config.app.charset');
$app->get('Mailer')->Host = $app->get('config.mail.host');
$app->get('Mailer')->SMTPAuth = TRUE;
$app->get('Mailer')->SMTPSecure = $app->get('config.mail.encryption');
$app->get('Mailer')->Port = $app->get('config.mail.port');
$app->get('Mailer')->Username = $app->get('config.mail.username');
$app->get('Mailer')->Password = $app->get('config.mail.password');
$app->get('Mailer')->setFrom($app->get('config.mail.username'), $app->get('config.app.name'));
$app->get('Mailer')->isHTML( TRUE );
		// Set debug
if($app->get('config.app.debug')){
		$app->get('Mailer')->SMTPDebug = TRUE;
	}
}

/*
 * Set Router
 */
$app->set('Router', new Datalaere\PHPMvcFramework\Router);
$app->get('Router')->setControllersPath(BASE_PATH . $app->get('config.router.storage') . DIRECTORY_SEPARATOR);
$app->get('Router')->setDefaultController($app->get('config.router.controller'));
$app->get('Router')->setDefaultAction($app->get('config.router.action'));
$app->get('Router')->setQueryString($app->get('config.router.queryString'));
$app->get('Router')->setNamespace($app->get('config.router.namespace'));

/*
 * Set custom providers
 */

/*
 * Return app and it's values
 */
return $app;