<?php
/*
 * Set PHP Session options
 */
session_save_path(STORAGE_PATH . $app->get('config.session.file') . DIRECTORY_SEPARATOR);
if (session_id() == '') {
	session_cache_limiter(false);
	session_set_cookie_params(0);
	session_name($app->get('config.session.name'));
	session_start();
}