<?php
/*
 * Set Router
 */
$app->set('Router', new WebSupportDK\PHPMvcFramework\Router);
$app->get('Router')->setControllersPath(BASE_PATH . $app->get('config.router.storage') . DIRECTORY_SEPARATOR);
$app->get('Router')->setDefaultController($app->get('config.router.controller'));
$app->get('Router')->setDefaultAction($app->get('config.router.action'));
$app->get('Router')->setQueryString($app->get('config.router.queryString'));
$app->get('Router')->setNamespace($app->get('config.router.namespace'));
