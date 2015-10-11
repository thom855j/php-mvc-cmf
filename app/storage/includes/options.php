<?php
/** 
 * Bootstrap options from db
 */

if(!defined('APP_DEFAULT_PAGE')):
	define('APP_DEFAULT_PAGE', $app->get('config')->site->{"default page"});
endif;