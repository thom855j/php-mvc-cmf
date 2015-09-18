<?php

use thom855j\PHPAuthFramework\Auth;
?>
<!DOCTYPE html>
<html lang="da">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Happy House">
        <meta name="author" content="Happy House">

        <title><?php echo App; ?> - <?php echo $this->current_page ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo $this->project_url; ?>public/assets/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo $this->project_url; ?>public/assets/lightbox2/dist/css/lightbox.css" rel="stylesheet">
        <!-- Custom CSS -->
        <link href="<?php echo $this->project_url; ?>app/view/theme/app/assets/css/style.css" rel="stylesheet">
        <!-- Google fonts -->
        <link href='https://fonts.googleapis.com/css?family=Ubuntu:300,700,400' rel='stylesheet' type='text/css'>
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'>
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>
        <?php
        if ($this->current_page == 'bruger')
        {
            $this->current_page = 'index';
        }
        ?>
        <div class="container-fluid">
            <div class="<?php echo $this->current_page; ?>-banner">
                <div class="header clearfix">
                    <nav>
                        <ul class="nav nav-pills pull-right">
                            <?php
                            $header_menu = unserialize(HEADER_MENU);
                            foreach ($header_menu as $menu)
                            {
                                ?>
                                <li role="presentation" >
                                    <a class=" a-bold"  href="<?php echo $this->project_url . $menu->Name ?>">
                                        <?php echo $menu->Label; ?>
                                    </a>
                                </li>
                                <?php
                            }

                            if (!isset($_SESSION['User']))
                            {
                                ?>
                                <li role="presentation" class="login-btn"><a  class=" a-bold" href="<?php echo $this->project_url; ?>login">Login</a></li>
                                <?php
                            }
                            else
                            {
                                if (Auth::load()->role('broker'))
                                {
                                    ?>
                                    <li role="presentation" class="login-btn"><a  class=" a-bold" href="<?php echo $this->project_url; ?>admin">Admin</a></li>
                                <?php } ?>
                                <li role="presentation" class="login-btn"><a  class=" a-bold" href="<?php echo $this->project_url; ?>min-side">Min side</a></li>
                                <li role="presentation" class="login-btn"><a  class=" a-bold" href="<?php echo $this->project_url; ?>auth/logout">Logout</a></li>
                                <?php } ?>
                        </ul>
                    </nav>
                    <a href="<?php echo $this->project_url; ?>"><img width="100" src="<?php echo $this->project_url; ?>app/view/theme/app/assets/img/logo/logo.png"></a>
                </div>
