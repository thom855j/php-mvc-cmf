<?php
/**
 * Start includesping
 */
// Absolute project path
define('ABSPATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
require_once ABSPATH. 'app/storage/includes/constants.php';
// load includes files
require_once APPINC . 'autoloader.php';
require_once APPINC . 'app.php';
require_once APPINC . 'debug.php';
require_once APPINC . 'database.php';
require_once APPINC . 'options.php';
require_once APPINC . 'languages.php';
require_once APPINC . 'templates.php';
require_once APPINC . 'themes.php';
require_once APPINC . 'constants.php';
require_once APPINC . 'functions.php';
require_once APPINC . 'cache.php';
require_once APPINC . 'router.php';

