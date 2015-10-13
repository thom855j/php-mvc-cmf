<!DOCTYPE html>

<html lang="<?php e(locale()) ?>">
	<head>
		<meta charset="<?php e(charset()) ?>">

		<title>Example view</title>
		<meta name="description" content="Example">
		<meta name="author" content="thom855j">

		<link rel="stylesheet" href="<?php e(asset('css/styles.css?v=1.0')) ?>" />

		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
	</head>

	<body>
		<h1><?php e(trans('messages.welcome')) ?></h1>
		<p><?php pr($this) ?></p>

		<script src="<?php e(asset('js/scripts.js')) ?>"></script>
	</body>
</html>