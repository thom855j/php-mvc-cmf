<?php
/**
 * PHP MVC CMF
 *
 * @author thom855j, with inspiration form panique/mini and CodeCourse
 * @license http://opensource.org/licenses/MIT MIT License
 */
// Get config
require_once '../app/config.php';
// Start Composers autoloader
require_once '../vendor/autoload.php';

// Start bootstrap of app
require_once '../app/bootstrap.php';
use WebSupportDK\PHPMvcFramework\Router;

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
