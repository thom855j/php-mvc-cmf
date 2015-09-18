<?php

use thom855j\PHPSecurity\Session;
use thom855j\PHPHtml\Form;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h1 class="base-color">
            Dine oplysninger - på et sted
        </h1>
        <br>
        <h2 class="base-color">Spørgsmål?</h2>
        <br><br>
        <a href="<?php echo $this->project_url; ?>#kontakt" class="more-btn base-contrast-background"><b>KONTAKT OS NU</b></a>
    </div>
</div>
</div>

<div class="page-wrapper">
    <div class="content-wrapper-less">
        <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php'); ?>
        <br>
        <div class="row">

            <div class="col-lg-4">
                <h2><?php echo Session::getKey('User', 'Username'); ?></h2>
                <br>
                <ul>
                    <li><a class="base-typo-color" href="<?php echo $this->project_url; ?>min-side/oplysninger">Brugeroplysninger</a></li>
                    <br>
                    <li><a class="base-typo-color" href="<?php echo $this->project_url; ?>min-side/favoritter">Favoritter</a></li>
                </ul>
            </div>

            <div class="col-md-8">
                <?php
                if (empty($this->data))
                {
                    ?>
                    <p class="font-size-18">Hejsa <?php echo Session::getKey('User', 'Username'); ?>! <br> Vælg en menu til venstre.</p>
                <?php } ?>
                <div class="row">
                    <?php
                    if (!empty($this->data->saves[0]))
                    {
                        foreach ($this->data->saves as $view)
                        {
                            ?>
                            <a href="<?php echo $this->project_url; ?>ejendom/<?php echo $view->ID; ?>">
                                <div style="padding: 0px 0px 25px 15px" class="col-md-6">
                                    <div class="text-caption carousel-inner">
                                        <?php
                                        if (!empty($view->Thumbnail))
                                        {
                                            ?>

                                            <img class="img-responsive" src="<?php echo $this->project_url; ?>public/uploads/source/<?php echo $view->Thumbnail ?>">

                                            <?php
                                        }
                                        else
                                        {
                                            ?>

                                            <img class="img-responsive" src="<?php echo $this->project_url; ?>public/uploads/source/placeholder.jpg">

                                            <?php
                                        }
                                        ?> 
                                        <?php
                                        if (!empty($view->Label))
                                        {
                                            ?>
                                            <div class="carousel-caption carousel-caption-paging base-contrast-background">

                                                <p><b><?php echo $view->Label; ?></b></p>

                                            </div>
                                        <?php } ?>
                                        <div class="carousel-caption text-left carousel-price-tag base-typo-background">
                                            <p><b>Pris <?php echo $view->Price; ?></b></p>
                                        </div>
                                    </div>
                                </div>
                                <div style="padding: 0px 0px 25px 0px;" class="col-md-6">
                                    <div class="text-caption carousel-inner">
                                        <div class="base-neutral-background content-excerpt-paging">
                                            <p class="font-400 font-size-18"><b><?php echo $view->City; ?></b>, <?php echo $view->Country; ?></p>
                                            <p class="font-300"><?php echo $view->Type; ?></p>
                                            <p><?php echo $view->Excerpt; ?></p>
                                            <div class="row ">
                                                <div class="col-md-4 text-center">
                                                    <p class="font-size-21">
                                                        <b><?php echo $view->Rooms; ?></b>
                                                    </p>
                                                    <p>Værelser</p>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <p class="font-size-21">
                                                        <b><?php echo $view->M2; ?></b>
                                                    </p>
                                                    <p>m2</p>
                                                </div>
                                                <div class="col-md-4 text-center">
                                                    <p class="font-size-21">
                                                        <b><?php echo $view->Bath_rooms; ?></b>
                                                    </p>
                                                    <p>Baderum</p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        if (Session::exists('User'))
                                        {
                                            ?>
                                            <div class="paging-btn-wrapper">
                                                <form action="<?php echo $this->project_url; ?>posts/favorite/slet" method="post" id="save-<?php echo $view->ID; ?>">
                                                    <!-- form elements -->
                                                    <a  onclick="document.getElementById('save-<?php echo $view->ID; ?>').submit()" href="#save" class="paging-btn base-contrast-background"><b>Slet</b></a>
                                                    <input type="hidden" name="user_id" value="<?php echo Session::getKey('User', 'ID'); ?>">
                                                    <input type="hidden" name="post_id" value="<?php echo $view->ID; ?>">
                                                    <input type="hidden" name="current_url" value="<?php echo $this->current_url; ?>">
                                                </form>

                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </a>
                            <?php
                        }
                    }
                    ?>
                </div>

                <?php
                if (!empty($this->data->saves))
                {
                    ?>
                    <div class=" text-center">
                        <ul class="pagination">
                            <?php
                            for ($x = 1; $x <= $this->data->total; $x++)
                            {
                                if ($this->current_url == $this->project_url . 'min-side/favoritter/' . $x)
                                {
                                    ?> 
                                    <li><a class="pager-active" href="<?php echo $this->project_url; ?>favoritter/alle/<?php echo $x; ?>"><?php echo $x; ?></a></li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?> 
                                    <li><a href="<?php echo $this->project_url; ?>favoritter/<?php echo Session::get('ORDER') . '/' . $x; ?>"><?php echo $x; ?></a></li>
                                    <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <?php
                }

                if (!empty($this->data->user[0]))
                {
                    ?>
                    <h2>Bruger oplysninger</h2>
                    <?php
                    foreach ($this->data->user as $user)
                    {
                        Form::start($this->project_url . 'users/update', "post");
                        Form::label('username', 'Brugernavn', " class='control-label'");
                        Form::input('text', 'username', $user->Username, "class='form-control' disabled");

                        Form::label('full_name', 'Navn', " class='control-label'");
                        Form::input('text', 'full_name', $user->Name, "class='form-control' required");

                        Form::label('email', 'Email', " class='control-label'");
                        Form::input('email', 'email', $user->Email, "class='form-control' required");

                        Form::input('hidden', 'ID', $user->ID);
                        Form::input('hidden', 'current', $this->current_url);

                        Form::space();
                        Form::submit('submit', 'Gem', "class='form-control btn-success'");

                        Form::end();
                    }
                }
                ?>
            </div>

        </div>
    </div>

</div>