<?php

use thom855j\PHPMultilingual\I18n;
?>
<div class="container">

    <form method="post" action="<?php echo $this->project_url ?>auth/verify" class="form-signin">
        <h2 class="form-signin-heading"><?php
            I18n::get('AUTH_SUB_HEADER', false)
            ?></h2>
            <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php'); ?>
        <label for="<?php
               I18n::get('USERS_USERNAME', false)
               ?>" class="control-label"><?php
            I18n::get('USERS_USERNAME', false)
            ?></label>
        <input type="text" name="<?php
               I18n::get('USERS_USERNAME', false)
               ?>" id="<?php
               I18n::get('USERS_USERNAME', false)
               ?>" class="form-control" placeholder="<?php
               I18n::get('USERS_USERNAME', false)
               ?>" required="" autofocus="">
        <label for="<?php
               I18n::get('USERS_PASSWORD', false)
               ?>" class="control-label"><?php
            I18n::get('USERS_PASSWORD', false)
            ?></label>
        <input type="password" name="<?php
               I18n::get('USERS_PASSWORD', false)
               ?>" id="<?php
               I18n::get('USERS_PASSWORD', false)
               ?>" class="form-control" placeholder="<?php
               I18n::get('USERS_PASSWORD', false)
               ?>" required="">
        <div class="checkbox">
            <label>
                <input type="checkbox" class="control-label" name="remember-me"> <?php
                I18n::get('AUTH_REMEMBER_ME', false)
                ?>
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit"><?php
            I18n::get('AUTH_LOGIN', false)
            ?></button><br>
        <a href="<?php echo $this->project_url ?>">Tilbage til hjemmeside</a>
        <a href="<?php echo $this->project_url; ?>auth/register">Register</a>
    </form>

</div> <!-- /container -->