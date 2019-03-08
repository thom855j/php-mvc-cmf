<?php
/**
 * PHP MVC CMF
 *
 * @author thom855j, with inspiration from Laravel
 * @license http://opensource.org/licenses/MIT MIT License
 */
/*
  |--------------------------------------------------------------------------
  | Register The Auto Loader
  |--------------------------------------------------------------------------
  |
  | Composer provides a convenient, automatically generated class loader for
  | our application. We just need to utilize it! We'll simply require it
  | into the script here so that we don't have to worry about manual
  | loading any of our classes later on. It feels nice to relax.
  |
 */

require __DIR__ . '/../bootstrap/autoload.php';

/*
  |--------------------------------------------------------------------------
  | Turn On The Lights
  |--------------------------------------------------------------------------
  |
  | We need to start the PHP development, so let us turn on the lights.
  | This bootstraps the framework and gets it ready for use, then it
  | will load up this application so that we can run it and send
  | the responses back to the browser and delight our users.
  |
 */

$app = require_once __DIR__ . '/../bootstrap/app.php';

/*
  |--------------------------------------------------------------------------
  | Run The Application
  |--------------------------------------------------------------------------
  |
  | Once we have the application, we can handle the incoming request
  | through the kernel, and send the associated response back to
  | the client's browser allowing them to enjoy the creative
  | and wonderful application we have prepared for them.
  |
 */

// mode switch
switch (APP_ENV) {

case 'local':

  // start script

  $rustart = getrusage();
  $app->get('Router')->run();
  // Check for http errors
  http_error_handler();

  // Script end

  $ru = getrusage();
  echo "<br>This process used " . rutime($ru, $rustart, "utime") . " ms for its computations\n";
  echo "It spent " . rutime($ru, $rustart, "stime") . " ms in system calls\n";
  break;

case 'production':
  // Get url
  $app->get('Cache')->setUrl(current_url());
  // Start cache
  $app->get('Cache')->start();
  // Run Router
  $app->get('Router')->run();
  // Check for http errors
  http_error_handler();
  // End and save cache if no errors
  $app->get('Cache')->stop();
  break;

default:
  // Default run
  $app->get('Router')->run();
  break;
  }
