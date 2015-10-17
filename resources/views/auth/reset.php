<!DOCTYPE html>
<!-- saved from url=(0040)http://getbootstrap.com/examples/signin/ -->
<html lang="<?php e(locale()) ?>">
<head>
    <meta charset="<?php e(charset()) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="">

    <title><?php e(trans('messages.auth.reset')) ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php e(component('bootstrap/dist/css/bootstrap.min.css')) ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php e(asset('auth/css/signin.css')) ?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php e(asset('js/ie-emulation-modes-warning.js')) ?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
<? $name = trans('messages.form.name.email') ?>
    <div class="container">
      <form class="form-signin">
        <h2 class="form-signin-heading"><?php e(trans('messages.auth.reset')) ?></h2>
        <label for="<?php e($name) ?>" class="sr-only"><?php e(trans('messages.form.email')) ?></label>
        <input type="email" id="<?php e($name) ?>" name="<?php e($name)  ?>" class="form-control" placeholder="Email address" required="" autofocus="">
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php e(trans('messages.form.submit.reset')) ?></button>
        <br>
         <a href="<?php e(url('auth/login')) ?>">Sign in</a>
      </form>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="<?php e(asset('js/ie10-viewport-bug-workaround.js')) ?>"></script>
  

</body></html>