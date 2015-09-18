<?php

use thom855j\PHPSecurity\Session;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h1 class="base-color">
            Er dette din drømmebolig?
        </h1>
        <br>
        <a href="<?php echo $this->project_url; ?>#kontakt" class="more-btn base-contrast-background"><b>KONTAKT OS NU</b></a>
    </div>
</div>
</div>

<div class="page-wrapper">
    <?php
    $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php');
    if (!empty($this->data->post[0]->ID))
    {
        foreach ($this->data->post as $view)
        {
            ?>

            <div class="content-wrapper">
                <div class="row ">
                    <div class="col-md-8">
                        <div class="text-caption-single carousel-inner">
                            <?php
                            if (!empty($view->Thumbnail))
                            {
                                ?>

                                <a  data-lightbox="thumbnail"  
                                    href="<?php echo $this->project_url; ?>public/uploads/source/<?php echo $view->Thumbnail ?>"
                                     data-title="<?php echo $view->City; ?>, <?php echo $view->Country; ?>" 
                                    >
                                    <img class="img-responsive" src="<?php echo $this->project_url; ?>public/uploads/source/<?php echo $view->Thumbnail ?>">
                                </a>
                                <?php
                            }
                            else
                            {
                                ?>
                                <a href="<?php echo $this->project_url; ?>public/uploads/source/placeholder.jpg">
                                    <img class="img-responsive" src="<?php echo $this->project_url; ?>public/uploads/source/placeholder.jpg">
                                </a>
                                <?php
                            }

                            if (!empty($view->Label))
                            {
                                ?>
                                <div class="carousel-caption single-caption base-contrast-background">

                                    <p><b><?php echo $view->Label; ?></b></p>

                                </div>
                            <?php } ?>
                        </div>
                        <br>
                        <div class="row gallery">
                           
                                <?php
                                if (!empty($this->data->uploads))
                                {
                                    foreach ($this->data->uploads as $upload)
                                    {
                                        $upload_path = $this->project_url . 'public/uploads/';
                                        $thumb       = $upload_path . 'thumbs/' . $upload->Slug;
                                        $source      = $upload_path . 'source/' . $upload->Slug;
                                        ?>
                                        <div class="col-md-4">

                                            <a href="<?php echo $source ?>" 
                                               data-lightbox="gallery"                                                      
                                               data-title="<?php echo $view->City; ?>, <?php echo $view->Country; ?>" >
                                                <img class="img-responsive" 
                                                     src="<?php echo $thumb; ?>" 
                                                     alt="<?php echo $view->City; ?>, <?php echo $view->Country; ?>" 
                                                     title="<?php echo $view->City; ?>, <?php echo $view->Country; ?>" />
                                            </a>
                                        </div>

                                        <?php
                                    }
                                }
                                ?>
                          
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="base-neutral-background content-excerpt">
        <!--                            <h2><?php echo $view->Title; ?></h2>-->
                            <p class="font-400 font-size-18"><b><?php echo $view->City; ?></b>, <?php echo $view->Country; ?></p>
                            <p class="font-300"><?php echo $view->Type; ?></p>
                            <p><?php echo $view->Content; ?></p>
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
                            <br> <br>
                            <p class="font-size-21"><b>Pris <?php echo $view->Price; ?></b></p>
                            <p>Mægler: <?php echo $view->Username; ?></p>
                        </div>
                        <br><br>
                        <?php
                        if (Session::exists('User'))
                        {
                            ?>

                            <div style="text-align: right; margin-top: 40%;">
                                <form action="<?php echo $this->project_url; ?>posts/favorite" method="post" id="save-<?php echo $view->ID; ?>">
                                    <!-- form elements -->
                                    <a  onclick="document.getElementById('save-<?php echo $view->ID; ?>').submit()" href="#save" class="more-btn base-contrast-background"><b>Gem</b></a>
                                    <input type="hidden" name="user_id" value="<?php echo Session::getKey('User', 'ID'); ?>">
                                    <input type="hidden" name="post_id" value="<?php echo $view->ID; ?>">
                                    <input type="hidden" name="current_url" value="<?php echo $this->current_url; ?>">
                                </form>
                            </div>
                        <?php } ?>

                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>
</div>