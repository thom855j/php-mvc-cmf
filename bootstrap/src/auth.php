<?php
/*
 * Set auth
 */
 use WebSupportDK\PHPAuthFramework\Auth;
 if($app->get('config.auth.status')){
 	$app->set('Auth', Auth::load());
 	$app->get('Auth')->setAttribute('db',$app->get('DB'));
 	$app->get('Auth')->setAttribute('token',$app->get('config.app.key'));
 	$app->get('Auth')->setAttribute('sessionName',$app->get('config.session.name'));
 }