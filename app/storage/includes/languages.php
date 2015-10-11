<?php
/**
 * Bootstrap language
 */
use WebSupportDK\PHPMultilingual\I18n;

if (!defined('APPLANG') && !defined('APPLOCALE')):
	define('APPLANG', $app->get('config')->site->lang);
	define('APPLOCALE', $app->get('config')->site->locale);
endif;

I18n::set(APPLOCALE);
