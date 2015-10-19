<?php
/*
 * Set mailer
 */
if ($app->get('config.mail.status')) {

// Get mail driver
req($app->get('__DIR__') . 'vendor/phpmailer/phpmailer/PHPMailerAutoload');
// Set driver
$app->set('Mailer', new PHPMailer);
if(!is_null($app->get('config.mail.driver'))){
	$app->get('Mailer')->isSMTP();
	}
$app->get('Mailer')->CharSet = $app->get('config.app.charset');
$app->get('Mailer')->Host = $app->get('config.mail.host');
$app->get('Mailer')->SMTPAuth = TRUE;
$app->get('Mailer')->SMTPSecure = $app->get('config.mail.encryption');
$app->get('Mailer')->Port = $app->get('config.mail.port');
$app->get('Mailer')->Username = $app->get('config.mail.username');
$app->get('Mailer')->Password = $app->get('config.mail.password');
$app->get('Mailer')->setFrom($app->get('config.mail.username'), $app->get('config.app.name'));
$app->get('Mailer')->isHTML( TRUE );
		// Set debug
if($app->get('config.app.debug')){
		$app->get('Mailer')->SMTPDebug = TRUE;
	}
}