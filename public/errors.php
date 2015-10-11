<?php
/*
 * Public errors handling
 */
use WebSupportDK\PHPHttp\Url;

switch (Url::getError()) {
	case 404:
		Url::redirect(Url::getRoot('public') . 'errors/code/404');
		break;

	default:
		break;
}

