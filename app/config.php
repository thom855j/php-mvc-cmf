<?php
/*
 * App config
 */

// App mode
define('APP_DEBUG', TRUE);

// App env
define('APP_ENV', 'development');

// App theme
define('APP_THEME', 'default');


// DB config
switch (APP_ENV) {
	case 'development':
		define('DB_TYPE', 'mysql');
		define('DB_HOST', '127.0.0.1');
		define('DB_NAME', 'MVC');
		define('DB_USER', 'root');
		define('DB_PASS', 'root');

		break;
	case 'production':


		break;

	default:
		break;
}
