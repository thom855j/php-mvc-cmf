<?php
/*
  |--------------------------------------------------------------------------
  | Create The Application
  |--------------------------------------------------------------------------
  |
  | The first thing we will do is create a new  application instance
  | which serves as the "glue" for all the components, and is
  | the IoC container for the system binding all of the various parts.
  |
 */
use WebSupportDK\PHPMvcFramework\App;

// Start app
$app = App::load();

/*
  |--------------------------------------------------------------------------
  | Basic helper functions
  |--------------------------------------------------------------------------
  |
  | Common functions for easier development (you can add your own here!).
  |
 */
require 'helpers.php';

/*
  |--------------------------------------------------------------------------
  | Set config
  |--------------------------------------------------------------------------
  |
  | Set the config settings for the app.
  |
 */
require 'config.php';

/*
  |--------------------------------------------------------------------------
  | App constants
  |--------------------------------------------------------------------------
  |
  | Set common app constants
  |
 */
require 'constants.php';


/*
  |--------------------------------------------------------------------------
  | PHP options
  |--------------------------------------------------------------------------
  |
  | Set common PHP options
  |
 */
require 'time.php';
require 'errors.php';
require 'session.php';

/*
  |--------------------------------------------------------------------------
  | Language selection
  |--------------------------------------------------------------------------
  |
  | To make a multilingual app we need to setup  language
  |
 */
require 'language.php';

/*
  |--------------------------------------------------------------------------
  | Bind Important Interfaces
  |--------------------------------------------------------------------------
  |
  | Next, we need to bind some important interfaces into the container so
  | we will be able to resolve them when needed.
  |
 */

require 'view.php';
require 'cache.php';
require 'database.php';
require 'auth.php';
require 'mail.php';
require 'router.php';

/*
  |--------------------------------------------------------------------------
  | Bind Custom Services
  |--------------------------------------------------------------------------
  |
  | Add services to the app if needed.
  |
 */
  require 'services.php';

/*
  |--------------------------------------------------------------------------
  | Return the app
  |--------------------------------------------------------------------------
  |
  | Return the app class with all the required setup
  |
 */
return $app;
