<?php
/**
 * Bootstrap router
 */
use WebSupportDK\PHPMvcFramework\Router;

$router = new Router();
$router->setControllersPath(CONTROLLERPATH);
$router->setDefaultController($app->get('config')->router->{'default controller'});
$router->setDefaultAction($app->get('config')->router->{'default action'});
$router->setQueryString($app->get('config')->router->{'query string'});

