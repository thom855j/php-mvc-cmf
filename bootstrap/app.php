<?php
/*
  |--------------------------------------------------------------------------
  | Include The Compiled File
  |--------------------------------------------------------------------------
  |
  | To dramatically increase your application's performance, you may use a
  | compiled file which contains all of the commonly used bootstrap files
  | by request.
  |
*/

  if(file_exists(__DIR__.'/cache/compiled.php'))
  {
  
  return require 'cache/compiled.php';

  }

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

require 'src/start.php';

  /*
  |--------------------------------------------------------------------------
  | Basic helper functions
  |--------------------------------------------------------------------------
  |
  | Common functions for easier development (you can add your own here!).
  |
 */

require 'src/helpers.php';

/*
  |--------------------------------------------------------------------------
  | Set config
  |--------------------------------------------------------------------------
  |
  | Set the config settings for the app.
  |
 */

require 'src/config.php';

/*
  |--------------------------------------------------------------------------
  | App paths
  |--------------------------------------------------------------------------
  |
  | Set common app paths
  |
 */

require 'src/paths.php';


/*
  |--------------------------------------------------------------------------
  | App constants
  |--------------------------------------------------------------------------
  |
  | Set common app constants
  |
 */

require 'src/constants.php';


/*
  |--------------------------------------------------------------------------
  | PHP options
  |--------------------------------------------------------------------------
  |
  | Set common PHP options
  |
 */

require 'src/time.php';
require 'src/errors.php';
require 'src/session.php';

/*
  |--------------------------------------------------------------------------
  | Language selection
  |--------------------------------------------------------------------------
  |
  | To make a multilingual app we need to setup  language
  |
 */

require 'src/language.php';

/*
  |--------------------------------------------------------------------------
  | Bind Important Interfaces
  |--------------------------------------------------------------------------
  |
  | Next, we need to bind some important interfaces into the container so
  | we will be able to resolve them when needed.
  |
 */

require 'src/view.php';
require 'src/cache.php';
require 'src/database.php';
require 'src/auth.php';
require 'src/mail.php';
require 'src/router.php';

/*
  |--------------------------------------------------------------------------
  | Bind Custom Services
  |--------------------------------------------------------------------------
  |
  | Add services to the app if needed.
  |
 */

require 'src/providers.php';


/*
  |--------------------------------------------------------------------------
  | Run Compiler
  |--------------------------------------------------------------------------
  |
  | To dramatically increase your application's performance, we compile
  | bootstrap files
  |
*/

if($app->get('config.compiler.status'))
{
  require 'compiler.php';
}  

/*
  |--------------------------------------------------------------------------
  | Return the app
  |--------------------------------------------------------------------------
  |
  | Return the app class with all the required setup
  |
 */

return require 'src/app.php';
