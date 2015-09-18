<div class="row" data-sr="wait 0.5s ease-in 50px">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h1 class="base-color">
          <?php echo Forside_overskrift; ?>
        </h1>
        <br>
        <a href="<?php echo $this->project_url; ?><?php echo Forside_link; ?>" class="more-btn base-contrast-background"><b><?php echo Forside_link_tekst; ?></b></a>
    </div>
</div>
</div>

<div class="content-wrapper base-neutral-background" data-sr="enter left">
    <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php'); ?>
    <div class="col-md-6 col-md-offset-3 text-center content-preview-header">
        <h2><?php echo Udpluk_af_boliger_overskrift; ?></h2>
    </div>
    <div class="row ">
        <?php
        if (!empty($this->data->post[0]->ID))
        {
            foreach ($this->data->post as $view)
            {
                ?>
                <a href="<?php echo $this->project_url; ?>ejendom/<?php echo $view->ID; ?>">
                    <div class="col-md-4">
                        <div class="text-caption carousel-inner">
                            <img class="img-responsive" src="<?php echo $this->project_url; ?>public/uploads/source/<?php echo $view->Thumbnail; ?>">
                            <?php
                            if (!empty($view->Label))
                            {
                                ?>
                                <div class="carousel-caption  base-contrast-background">

                                    <p><b><?php echo $view->Label; ?></b></p>

                                </div>
                            <?php } ?>
                        </div>
                        <div class="base-background content-excerpt">
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
                    </div>
                </a>
                <?php
            }
        }
        ?>
    </div>
</div>

<div class="page-wrapper" data-sr="enter right over 0.5s">

    <div class="content-wrapper base-background">
        <div class="row ">
            <div class="col-md-6 content">
                <h2><?php echo Afdelinger_overskrift; ?></h2>
                <div class="splitter"></div>
                <p>
                   <?php echo Afdelinger_indhold; ?>
                </p>
            </div>
            <div class="col-md-5  content col-md-offset-1">
                <img src="<?php echo $this->project_url; ?>app/view/theme/app/assets/img/logo/kort.jpg" class="img-responsive">
            </div>
        </div>

    </div>
    <div class="contact-box base-contrast-background">
        <p class="base-color  text-left font-weight-bold">RING OG FÅ EN AFTALE</p>
        <p class="base-color font-size-30 text-left font-weight-bold"><?php echo Telefonnummer; ?></p>
    </div>
</div>

<div class="bottom-banner" data-sr="enter right over 0.5s">
    <div class="content-wrapper ">
        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <h2 class="base-color">
                    <b><?php echo Kontaktformular_overskrift; ?></b>
                </h2>
                <p class="base-color">
                  <?php echo Kontaktformular_undertekst; ?>
                </p>
            </div>
            <div class="col-md-6 content">
                <div id="kontakt" class="contact-form-wrapper base-neutral-background">
                    <div class="row">

                        <div class="col-md-7">
                            <form action="<?php echo $this->project_url; ?>messages/create" method="post">
                                <label for="name" class="control-label">Fulde navn</label>
                                <input id="name" name="name" type="text" class="form-control" required="required">
                                <br>
                                <label for="email" class="control-label">Email</label>
                                <input id="email" name="email" type="text" class="form-control" required="required">
                                <br>
                                <label for="message" class="control-label">Besked</label>
                                <textarea name="content"  id="message" class="form-control" required="required"></textarea>
                                <br>
                                <input class="btn btn-block bold btn-large btn-lg input-btn base-color base-contrast-background" type="submit" name="submit" value="KONTAKT MIG NU">
                            </form>
                        </div>

                        <div class="col-md-5">
                            <p>Udfyld formulareng og lad os kontakte dig.</p>
                            <br>
                            <p>Vi hjælper dig igennem hele din process, uanset om du køber eller sælger.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="page-wrapper" data-sr="enter bottom over 0.5s">
    <div id="partnere" class="content-wrapper base-background">
        <div class="row">
            <div class="col-md-7 content-header col-md-offset-3">
                <h2>Mød vores samarbejdspartnere</h2>
            </div>
        </div>
        <div class="row ">
            <div class="col-md-4  content">
                <img  src="<?php echo $this->project_url; ?>app/view/theme/app/assets/img/logo/logo-1.png" class="img-responsive">
            </div>
            <div class="col-md-4 content">
                <img  src="<?php echo $this->project_url; ?>app/view/theme/app/assets/img/logo/logo-2.png" class="img-responsive">
            </div>
            <div class="col-md-4 content">
                <img  src="<?php echo $this->project_url; ?>app/view/theme/app/assets/img/logo/logo-3.png" class="img-responsive">
            </div>
        </div>
    </div>
