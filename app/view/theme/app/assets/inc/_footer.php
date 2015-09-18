</div>
<!-- /#page-wrapper -->

<div class=" content-wrapper footer base-typo-background" data-sr="enter top over 0.5s">
    <div class="row content">
        <div class="col-md-3 base-color">
            <p class="font-weight-bold">Happy House</p>
            <p>
                <?php echo Adresse; ?>
                <br>
                <?php echo Postnummer; ?>  <?php echo By; ?>
                <br>
                <?php echo Land; ?>
                <br>
                CVR: <?php echo CVR; ?>
            </p>
        </div>
        <div class="col-md-3  base-color">
            <p class="font-weight-bold">Kontaktoplysninger</p>
            <p>
                <?php echo Telefonnummer; ?>
                <br>
                <?php echo Email; ?>
            </p>
        </div>

        <div class="col-md-3 base-color">
            <p class="font-weight-bold">Åbningstider</p>
            <p>
                <?php echo Åbningstider_hverdage; ?>
                <br>
                <?php echo Åbningstider_weekend; ?>
                <br>
                <?php echo Åbningstider_helligdage; ?>
            </p>
        </div>

        <div class="col-md-3 base-color">
            <p class="font-weight-bold">Navigation</p>
            <ul class="base-color">
                <?php
                foreach (unserialize(FOOTER_MENU) as $menu)
                {
                    ?>
                    <li><a class="base-color" href="<?php echo $this->project_url . $menu->Name; ?>"><?php echo $menu->Label; ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <br>
        <div class=" text-center">
            <br><br>
            <a href="<?php echo $this->project_url; ?><?php echo Footer_button_link; ?>" class="more-btn base-contrast-background">
                <b><?php echo Footer_button_text; ?></b></a>
            <br><br>
            <a href="<?php echo $this->project_url; ?><?php echo Footer_contact_link ?>" class="btn-contact">
                <?php echo Footer_contact_text ?></a>
        </div>
    </div>
</div>

</div>
<!-- /#container -->


<!-- jQuery -->
<script type="text/javascript" src="<?php echo $this->project_url; ?>public/assets/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script type="text/javascript" src="<?php echo $this->project_url; ?>public/assets/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- plugins -->
<script type="text/javascript" src="<?php echo $this->project_url; ?>public/assets/lightbox2/dist/js/lightbox.min.js"></script>
<script type="text/javascript" src="<?php echo $this->project_url; ?>public/assets/scroll-reveal/dist/scrollReveal.min.js"></script>
<script>
    //Scroll to location
    $(function () {
        $('a[href*=#]:not([href=#])').click(function () {
            if (location.pathname.replace(/^\//, '') === this.pathname.replace(/^\//, '') && location.hostname === this.hostname) {

                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
                if (target.length) {
                    $('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1500);
                    return false;
                }
            }
        })
    });
    
// scroll reveal
     (function ($) {

        'use strict';

        window.sr = new scrollReveal({
            reset: true,
            mobile: true
        });

    })();

// lightbox init
    lightbox.option({
        'resizeDuration': 200,
        'wrapAround': true
    })
</script>

</body>
</html>
