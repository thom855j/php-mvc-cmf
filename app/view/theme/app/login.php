<div class="row">
    <div class="col-md-6 col-md-offset-3 text-center">
        <h1 class="base-color">
            Login / Opret dig som mægler
        </h1>
    </div>
</div>
</div>

<div class="page-wrapper">
    <div id="form" class="content-wrapper">
        <?php $this->renderFeedback(PATH_APP_VIEWS . 'system/feedback.php'); ?>
        <div class="row ">
            <div class="col-md-5">
                <h2>Allerede bruger</h2>
                <br>
                <div class="form">
                    <form action="<?php echo $this->project_url; ?>auth/verify" method="post">
                        <label for="Brugernavn" class="control-label">Brugernavn</label>
                        <input id="Brugernavn" name="username" type="text" class="form-control" required="required">
                        <br>
                        <label for="Kodeord" class="control-label">Kodeord</label>
                        <input id="Kodeord" name="password" type="text" class="form-control" required="required">

                        <br>
                        <input class="btn btn-block bold btn-large btn-lg input-btn base-color base-contrast-background" type="submit" name="submit" value="LOGIN">
                    </form>
                </div>


            </div>

            <div class="col-md-7">
                <h2>Opret dig som mægler</h2>
                <br>
                <div class="form">
                    <div class="row">
                        <div class="col-md-8">
                            <form action="<?php echo $this->project_url; ?>users/create" method="post">
                                <label for="name" class="control-label">Fulde navn *</label>
                                <input id="name" type="text" name="full_name" class="form-control" required="required">
                                <br>
                                <label for="org" class="control-label">Virksomhed </label>
                                <input id="org" type="text" name="org" class="form-control">
                                <br>
                                <label for="email" class="control-label">E-mail adresse *</label>
                                <input id="email" type="text" name="email" class="form-control" required="required">
                                <br>
                                <label for="user_type" class="control-label">Brugertype</label>
                                <select id="user_type" class="form-control"  name="user_type">
                                    <option value="3">Alm. bruger</option>
                                    <option value="2">Mægler</option>
                                </select>
                                <br>
                                <label for="username" class="control-label">Brugernavn *</label>
                                <input id="username" type="text" name="username" class="form-control" required="required">
                                <br>
                                <label for="password" class="control-label">Adgangskode *</label>
                                <input id="password" type="text" name="password" class="form-control" required="required">
                                <br>
                                <input class="btn btn-block bold btn-large btn-lg input-btn base-color base-contrast-background" type="submit" name="submit" value="OPRET DIG SOM MÆGLER">
                            </form>
                        </div>

                        <div class="col-md-4">
                            <p>Udfyld formulareng og opret dig som mægler.</p>
                            <br>
                            <p>Så kan du fremvise dine boliger på Danmarks største boligportal.</p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
