<?php
/*
 * App paths
 */
define('APP_PUBLIC', BASE_PATH . 'public' . DIRECTORY_SEPARATOR);
define('APP_UPLOAD', APP_PUBLIC . $app->get('config.filesystem.upload') . DIRECTORY_SEPARATOR);
define('APP_STORAGE', BASE_PATH . 'storage' . DIRECTORY_SEPARATOR);

/*
 * URL paths
 */
define('APP_ASSET', $app->get('config.app.url') . 'public/assets' . DIRECTORY_SEPARATOR);
define('APP_COMPONENT', $app->get('config.app.url') . 'public/components' . DIRECTORY_SEPARATOR);

/*
 * Resources path
 */
define('APP_RESOURCE', BASE_PATH . 'resources' . DIRECTORY_SEPARATOR);
define('APP_LANG', APP_RESOURCE . 'lang' . DIRECTORY_SEPARATOR);

/*
 * Storage paths
 */
define('APP_VIEW', APP_RESOURCE . $app->get('config.view.storage') . DIRECTORY_SEPARATOR);
define('APP_CACHE_STORAGE', APP_STORAGE . $app->get('config.cache.storage') . DIRECTORY_SEPARATOR);
define('APP_CONTROLLER', BASE_PATH . $app->get('config.router.storage') . DIRECTORY_SEPARATOR);

/*
 * PHP ini paths
 */
ini_set('upload_tmp_dir', APP_STORAGE . 'framework/app' . DIRECTORY_SEPARATOR); 

