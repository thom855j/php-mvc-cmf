<?php

use thom855j\PHPSecurity\Session;
?>
<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h1 class="base-color">
            Søg i vores boligportal og find din drømmebolig
        </h1>
    </div>
</div>
</div>
<div class="col-md-6 col-md-offset-3 text-center content-preview-header">

</div>
<div class="page-wrapper">

    <div class="content-wrapper-less">
        <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php'); ?>
        <div class="text-right">
            Sorter efter: &nbsp;&nbsp;&nbsp;&nbsp;
            <?php
            $price_active   = '';
            $lastest_active = '';
            if (Session::exists('ORDER'))
            {
                if (Session::get('ORDER') == 'pris')
                {
                    $price_active = 'active';
                }
                if (Session::get('ORDER') == 'seneste')
                {
                    $lastest_active = 'active';
                }
            }
            ?>
            <a class="<?php echo $lastest_active; ?>" href="<?php echo $this->project_url; ?>ejendomme/seneste">Seneste</a> 
            &nbsp;
            <a class="<?php echo $price_active; ?>" href="<?php echo $this->project_url; ?>ejendomme/pris">Pris</a>

            <br>  <br>  <br>
        </div>
        <div class="row ">
            <div class="col-md-4">
                <div class="form-header">
                    <p class="font-size-18 font-weight-bold base-color">Boligsøgning</p>
                </div>
                <div class="form">
                    <form action="<?php echo $this->project_url; ?>ejendomme" method="post">
                        <label for="city" class="control-label"><p class="font-size-18 font-weight-bold">Find din drømmeejendom</p></label>
                        <input id="city" name="city" type="search" placeholder="Søg efter bynavn" class="form-control" >
                        <br>
                        <div class="form-splitter"></div>
                        <br>
                        <p style="text-align: center" class="font-size-18 font-weight-bold">Udvidet søgning</p>
                        <br>
                        <label for="flat_type" class="control-label">Boligtype</label>
                        <select id="flat_type" class="form-control"  name="type">
                            <option value="Hus" selected>Hus</option>
                            <option value="Lejlighed">Lejlighed</option>
                        </select>
                        <br>
                        <label for="flat_type" class="control-label">Status</label>
                        <br>
                        <div style="text-align: center; ">
                            Til salg <input class="base-contrast-background" type="radio" name="status" value="0" checked>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            Solgt <input type="radio" name="status" value="3">
                        </div>
                        <br>   <br>
                        <input class="btn btn-block bold btn-large btn-lg input-btn base-color base-contrast-background" type="submit" name="search_submit" value="FIND DIN DRØMMEBOLIG">
                    </form>
                </div>
            </div>

            <div class="col-md-8">
                <div class="row">
                    <?php
                    if (!empty($this->data->post[0]->ID))
                    {
                        foreach ($this->data->post as $view)
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
                                                <form action="<?php echo $this->project_url; ?>posts/favorite" method="post" id="save-<?php echo $view->ID; ?>">
                                                    <!-- form elements -->
                                                    <a  onclick="document.getElementById('save-<?php echo $view->ID; ?>').submit()" href="#save" class="paging-btn base-contrast-background"><b>Gem</b></a>
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
                    else
                    {
                        ?>
                        <p class="text-center font-size-21 font-weight-bold">Ingen resultater.</p>  
                        <?php
                    }
                    ?>
                </div>
                <div class=" text-center">
                    <ul class="pagination">
                        <?php
                        for ($x = 1; $x <= $this->data->total; $x++)
                        {
                            if ($this->current_url == $this->project_url . 'ejendomme/' . $x)
                            {
                                ?> 
                                <li><a class="pager-active" href="<?php echo $this->project_url; ?>ejendomme/alle/<?php echo $x; ?>"><?php echo $x; ?></a></li>
                                    <?php
                                }
                                else
                                {
                                    ?> 
                                <li><a href="<?php echo $this->project_url; ?>ejendomme/<?php echo Session::get('ORDER') . '/' . $x; ?>"><?php echo $x; ?></a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>

        </div>

    </div>
</div>