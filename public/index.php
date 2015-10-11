<?php
/**
 * PHP MVC CMF
 *
 * @author thom855j, with inspiration form panique/mini and CodeCourse
 * @license http://opensource.org/licenses/MIT MIT License
 */

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
