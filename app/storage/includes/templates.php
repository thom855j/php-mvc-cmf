<?php
/**
 * Bootstrap template
 */
use WebSupportDK\PHPMvcFramework\View;

define('CONTROLLERPATH', ABSPATH . 'app/Controllers' .DIRECTORY_SEPARATOR);
if (!defined('APP_DEFAULT_THEME')):
	define('APP_DEFAULT_THEME', $app->get('config')->site->{'default theme'});
endif;
define('TEMPLATEPATH', APPTHEME . APP_DEFAULT_THEME . DIRECTORY_SEPARATOR);

$view = View::load();
$view->setTemplatePath(TEMPLATEPATH);
$view->setFeedbackFile(APPTEMPLATE . 'feedback');


