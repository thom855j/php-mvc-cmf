<?php

// set a constant that holds the project's folder path, like "/var/www/". 
// DIRECTORY_SEPARATOR adds a slash to the end of the path 
define('PATH_ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// set a constant that holds the project's "application" folder, like "/var/www/application". 
define('PATH_APP', PATH_ROOT . 'app' . DIRECTORY_SEPARATOR);
// set storage path
define('PATH_STORAGE', PATH_APP . 'storage' . DIRECTORY_SEPARATOR);
// set i18n path
define('PATH_I18n', PATH_STORAGE . 'i18n' . DIRECTORY_SEPARATOR);

// set app mvc folders for routing of application 
define('PATH_APP_CONTROLLERS', PATH_APP . 'controller' . DIRECTORY_SEPARATOR);
define('PATH_APP_VIEWS', PATH_APP . 'view' . DIRECTORY_SEPARATOR);
define('PATH_APP_MODELS', PATH_APP . 'model' . DIRECTORY_SEPARATOR);

// set public uploads folders 
define('PATH_PUBLIC_UPLOADS_SOURCE', PATH_ROOT . 'public/uploads/source' . DIRECTORY_SEPARATOR);
define('PATH_PUBLIC_UPLOADS_THUMBS', PATH_ROOT . 'public/uploads/thumbs' . DIRECTORY_SEPARATOR);

// set vendor folder dependencies 
define('PATH_VENDOR', PATH_ROOT . 'vendor' . DIRECTORY_SEPARATOR);


// this is the (totally optional) auto-loader for Composer-dependencies (to load tools into your project). 
require_once PATH_VENDOR . 'autoload.php';

// load application config (error reporting etc.) 
require_once(PATH_APP . 'config.php');

// load app
require_once(PATH_APP . 'App.php');

// set app env
App::load()->set('env', DEBUG);

// define required files to bootstrap
use thom855j\PHPMultilingual\I18n,
    thom855j\PHPScrud\DB,
    thom855j\PHPAuthFramework\Auth,
    thom855j\PHPSecurity\Validator;

// set locale
I18n::set(LOCALE);

// register i18n paths
I18n::register(PATH_I18n . 'system', 'system');
I18n::register(PATH_I18n . 'auth', 'auth');
I18n::register(PATH_I18n . 'validate', 'validate');
I18n::register(PATH_I18n . 'posts', 'posts');
I18n::register(PATH_I18n . 'users', 'users');
I18n::register(PATH_I18n . 'uploads', 'uploads');
I18n::register(PATH_I18n . 'messages', 'messages');

// load the database
DB::load(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);

// load options
DB::load()->query('SELECT Name, Value FROM Options');
foreach (DB::load()->results() as $option)
{
    define($option->Name, $option->Value);
}

// set app date format from DB
App::load()->set('date_format', Date_format);

// set header from DB
$header_menu = DB::load()->query(
                "SELECT Menus.ID, Menus.Label, Menus.Name, Menus.Sort, Menus.Parent_ID, 
Menus.Type FROM Menus WHERE Menus.Type = ?ORDER BY Menus.Sort", array('header')
        )->results();
define('HEADER_MENU', serialize($header_menu));

// set footer from DB
$footer_menu = DB::load()->query(
                "SELECT Menus.ID, Menus.Label, Menus.Name, Menus.Sort, Menus.Parent_ID, 
Menus.Type FROM Menus WHERE Menus.Type = ?ORDER BY Menus.Sort", array('footer')
        )->results();
define('FOOTER_MENU', serialize($footer_menu));

// load auth framework and inject db
Auth::load()->setAttribute('db', DB::load());

// set system token for encryption
Auth::load()->setAttribute('token', TOKEN);

// load validator
Validator::load()->setAttribute('db', DB::load());

// set validate feedback 
Validator::load()->setFeedback('req', I18n::get('VALIDATE_REQ'));
Validator::load()->setFeedback('min', I18n::get('VALIDATE_MIN'));
Validator::load()->setFeedback('max', I18n::get('VALIDATE_MAX'));
Validator::load()->setFeedback('chars', I18n::get('VALIDATE_CHARS'));
Validator::load()->setFeedback('match', I18n::get('VALIDATE_MATCH'));
Validator::load()->setFeedback('exists', I18n::get('VALIDATE_EXISTS'));
Validator::load()->setFeedback('invalid', I18n::get('VALIDATE_INVALID'));
Validator::load()->setFeedback('input', I18n::get('VALIDATE_INPUT'));
Validator::load()->setFeedback('spaces', I18n::get('VALIDATE_SPACES'));
Validator::load()->setFeedback('number', I18n::get('VALIDATE_NUMBER'));
Validator::load()->setFeedback('ext', I18n::get('VALIDATE_EXT'));
Validator::load()->setFeedback('size', I18n::get('VALIDATE_SIZE'));

//continue to app routing