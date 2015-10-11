<?php
/**
 * PHP MVC CMF
 *
 * @author thom855j, with inspiration form panique/mini and CodeCourse
 * @license http://opensource.org/licenses/MIT MIT License
 */
<<<<<<< HEAD
ini_set('display_errors', true);
// Start bootstrap of app
require_once '../app/bootstrap.php';

// mode switch
switch ($app->get('mode')) {

	case 'development':
		// start script
		$rustart = getrusage();
		$router->run();
		
		// Script end
		$ru = getrusage();
		echo "This process used " . rutime($ru, $rustart, "utime") .
		" ms for its computations\n";
		echo "It spent " . rutime($ru, $rustart, "stime") .
		" ms in system calls\n";
		break;

	case 'production':
		$cache->setUrl(WebSupportDK\PHPHttp\Url::get());
		$cache->start();
		$router->run();
		$cache->stop();
		break;

	default:
		$router->run();
		break;
}


require_once 'errors.php';
=======
// Get config
require_once '../app/config.php';
// Start Composers autoloader
require_once '../vendor/autoload.php';

// Start bootstrap of app
require_once '../app/bootstrap.php';
use WebSupportDK\PHPMvcFramework\Router;
>>>>>>> origin/master

$params = array(
	'controller' => 'page',
	'action' => 'name',
	'path_controller' => PATH_APP_CONTROLLERS,
	'root_url' => 'url'
);


$app = new Router($params);

use WebSupportDK\PHPHttp\Url;

switch (Url::getError()) {
	case 404:
		Url::redirect(Url::getRoot('public'). 'error/code/404');

		break;

	default:
		break;
}
