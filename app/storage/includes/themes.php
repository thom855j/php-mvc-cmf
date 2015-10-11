<?php
/**
 * Bootstrap themes
 */
$app->set('theme', json_decode(file_get_contents(TEMPLATEPATH . 'theme.json')));
if (file_exists(TEMPLATEPATH . 'functions.php')):
	require_once TEMPLATEPATH . 'functions.php';	
endif;
