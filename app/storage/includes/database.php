<?php
/*
 * Bootstrap database
 */
use WebSupportDK\PHPScrud\DB;

define('DB_DRIVER', $app->get('config')->db->driver);
define('DB_HOST', $app->get('config')->db->host);
define('DB_NAME', $app->get('config')->db->name);
define('DB_USER', $app->get('config')->db->username);
define('DB_PASS', $app->get('config')->db->password);
define('DB_CHARSET', $app->get('config')->db->charset);
define('DB_COLLATION', $app->get('config')->db->collation);
define('DB_PREFIX', $app->get('config')->db->prefix);

DB::load(DB_DRIVER, DB_HOST, DB_NAME, DB_USER, DB_PASS);
