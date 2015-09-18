<div class="container">

    <form method="post" action="<?php echo $this->project_url; ?>auth/create" class="form-signin">
        <h2 class="form-signin-heading">Register</h2>
        <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php') ;  ?>
        <label for="<?php I18n::get('USERS_USERNAME',false); ?>" class="sr-only">Brugernavn</label>
        <input type="text" name="<?php I18n::get('USERS_USERNAME',false); ?>" id="<?php I18n::get('USERS_USERNAME',false); ?>" class="form-control" placeholder="Username" required="" autofocus="">
        <label for="<?php I18n::get('USERS_PASSWORD',false); ?>" class="sr-only">Adgangskode</label>
        <input type="password" name="<?php I18n::get('USERS_PASSWORD',false); ?>" id="<?php I18n::get('USERS_PASSWORD',false); ?>" class="form-control" placeholder="Password" required="">
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Husk mig
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button><br>
        <a href="<?php echo $this->project_url; ?>">Tilbage til hjemmeside</a>
        <a href="<?php echo $this->project_url; ?>auth/login">Log ind</a>
    </form>

</div> <!-- /container -->