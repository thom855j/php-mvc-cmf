<?php
/**
 * PHP MVC CMF
 *
 * @author thom855j, with inspiration from Laravel
 * @license http://opensource.org/licenses/MIT MIT License
 */
/*
  |--------------------------------------------------------------------------
  | Register The Auto Loader
  |--------------------------------------------------------------------------
  |
  | Composer provides a convenient, automatically generated class loader for
  | our application. We just need to utilize it! We'll simply require it
  | into the script here so that we don't have to worry about manual
  | loading any of our classes later on. It feels nice to relax.
  |
 */

require __DIR__ . '/../bootstrap/autoload.php';

/*
  |--------------------------------------------------------------------------
  | Turn On The Lights
  |--------------------------------------------------------------------------
  |
  | We need to illuminate PHP development, so let us turn on the lights.
  | This bootstraps the framework and gets it ready for use, then it
  | will load up this application so that we can run it and send
  | the responses back to the browser and delight our users.
  |
 */

$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
  |--------------------------------------------------------------------------
  | Run The Application
  |--------------------------------------------------------------------------
  |
  | Once we have the application, we can handle the incoming request
  | through the kernel, and send the associated response back to
  | the client's browser allowing them to enjoy the creative
  | and wonderful application we have prepared for them.
  |
 */

// mode switch
switch (APP_ENV) {

	case 'local':
		// start script
		$rustart = getrusage();
		$app->get('Router')->run();

		// Script end
		$ru = getrusage();
		echo "This process used " . rutime($ru, $rustart, "utime") .
		" ms for its computations\n";
		echo "It spent " . rutime($ru, $rustart, "stime") .
		" ms in system calls\n";
		break;

	case 'production':
		$app->get('Cache')->setUrl(WebSupportDK\PHPHttp\Url::get());
		$app->get('Cache')->start();
		$app->get('Router')->run();
		$app->get('Cache')->stop();
		break;

	default:
		$app->get('Router')->run();
		break;
}

/*
 * Custom header errors handeling
 */
use WebSupportDK\PHPHttp\Url;

switch (Url::getError()) {
	case 404:
		Url::redirect(Url::getRoot('public') . 'errors/code/404');
		break;

	default:
		break;
}
