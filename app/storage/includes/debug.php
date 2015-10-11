<?php
/**
 * Bootstrap debug
 */
if($app->get('config')->debug->status):
ini_set('display_errors', TRUE);
endif;