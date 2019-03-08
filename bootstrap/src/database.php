<?php
/*
 * Set database
 */
use Datalaere\PHPScrud\DB;
if ($app->get('config.database.status')) {
	$app->set('DB', DB::load(
		$app->get('config.database.driver'), 
		$app->get('config.database.host'), 
		$app->get('config.database.name'), 
		$app->get('config.database.username'), 
		$app->get('config.database.password')

	));
}
