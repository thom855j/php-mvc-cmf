<?php

/*
 * Env setup
 */
define('DEBUG', false);
define('ENV', 'local');

/*
 * App setup
 */
define('LOCALE', 'da_DK');
define('THEME', 'app');
define('TOKEN', 'H4qRRbMkUpgvw==');

/*
 * Set db config
 */
if (ENV == 'local')
{
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_PREFIX', "");
    define('DB_NAME', 'php-mvc-cmf');
    define('DB_USER', 'root');
    define('DB_PASS', '');
}
elseif (ENV == 'remote')
{
    define('DB_TYPE', 'mysql');
    define('DB_HOST', '127.0.0.1');
    define('DB_PREFIX', "");
    define('DB_NAME', 'scht16_wi9_sde_dk');
    define('DB_USER', 'scht16.wi9');
    define('DB_PASS', 'yz3qk3k4');
}
