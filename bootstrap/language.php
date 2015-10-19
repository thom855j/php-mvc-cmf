<?php
use WebSupportDK\PHPSecurity\Cookie;
use WebSupportDK\PHPSecurity\Session;
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