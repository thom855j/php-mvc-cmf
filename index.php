<?php

/**
 * Eksamensprojekt 2015: Happy House 
 *
 * @author thom855j, with inspiration form panique/mini and CodeCourse
 * @license http://opensource.org/licenses/MIT MIT License
 */

// boostrap app
require_once 'app/bootstrap.php' ;

// start the application routing by defining query string "url" 
// and absolute path to app controllers.
use thom855j\PHPHttp\Router;
$app = new Router( 'url' , PATH_APP_CONTROLLERS ) ;

// for debug
if(DEBUG === true){
    var_dump( $app );
}

