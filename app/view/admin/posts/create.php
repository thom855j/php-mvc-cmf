<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"><?php
I18n::get('POSTS_CREATE', false);
?></h2> 
    <?php
Form::start($this->current_url, "post");
Form::label('city', I18n::get('POSTS_CITY'), "class='control-label'");
Form::input('text', 'city', null, "class='form-control' required");

Form::label('country', I18n::get('POSTS_COUNTRY'), "class='control-label'");
Form::input('text', 'country', null, "class='form-control' required");

Form::label('type', I18n::get('POSTS_TYPE'), "class='control-label' required");
?>
<select class="form-control" name="type" id="type" required>
    <option value="Hus">Hus</option>
    <option value="Lejlighed">Lejlighed</option>
</select>
<?php
Form::label('content', I18n::get('POSTS_CONTENT'), "class='control-label'");
Form::textarea('content', " class='form-control' required", null);

Form::label('excerpt', I18n::get('POSTS_EXCERPT'), "class='control-label'");
Form::textarea('excerpt', " class='form-control' required", null);

Form::label('rooms', I18n::get('POSTS_ROOMS'), "class='control-label'");
Form::input('number', 'rooms', null, "class='form-control' required");

Form::label('m2', I18n::get('POSTS_M2'), "class='control-label'");
Form::input('number', 'm2', null, "class='form-control' required");

Form::label('bath_rooms', I18n::get('POSTS_BATHROOMS'), "class='control-label'");
Form::input('number', 'bath_rooms', null, "class='form-control' required");

Form::label('price', I18n::get('POSTS_PRICE'), "class='control-label' required");
Form::input('number', 'price', null, "class='form-control'");


Form::label('status', I18n::get('POSTS_STATUS'), "class='control-label'");
?>
<select class="form-control" name="status" id="status" required>
    <option value="0">Aktiv</option>
    <option value="3">Solgt</option>
    <option value="4">Nyhed</option>
</select>

<?php
$upload_path = $this->project_url . 'public/uploads/';
if (isset($this->results->uploads))
{

    foreach ($this->results->uploads as $upload)
    {

        $thumb  = $upload_path . 'thumbs/' . $upload->Slug;
        $source = $upload_path . 'source/' . $upload->Slug;

        $uploads[] = Form::options($upload->ID, $source, "data-img-src='$thumb'");

        $thumbnail[] = Form::options($upload->Slug, $source, "data-img-src='$thumb'");
    }
}

if (isset($uploads))
{

    Form::label('thumbnail', I18n::get('POSTS_THUMBNAIL'), "class='control-label'");
    ?>
    <!-- Modal HTML -->
    <div id="thumbnail" class="modal large fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php I18n::get('POSTS_MEDIA', false) ?></h4>
                </div>
                <div class="modal-body">

                    <?php
                    Form::select('thumbnail', $thumbnail, " id='thumbnail-picker' required class='form-control'");
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                </div>
            </div>
        </div>
    </div>    
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#thumbnail" role="button" class="btn btn-large btn-default" data-toggle="modal">Vælg</a>
    <br>

    <?php
    Form::label('uploads', I18n::get('POSTS_MEDIA'), "class='control-label'");
    ?>
    <!-- Modal HTML -->
    <div id="media" class="modal large fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?php I18n::get('POSTS_MEDIA', false) ?></h4>
                </div>
                <div class="modal-body">

                    <?php
                    Form::select('uploads[]', $uploads, " id='media-picker'  multiple class='form-control'");
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">X</button>
                </div>
            </div>
        </div>
    </div>    
    <!-- Button HTML (to Trigger Modal) -->
    <a href="#media" role="button" class="btn btn-large btn-default" data-toggle="modal">Vælg</a>
    <br>
    <?php
}
Form::space(1);
Form::input('hidden', 'current_url', $this->current_url);
Form::submit('submit', I18n::get('POSTS_SAVE'), "class='form-control btn-success'");
Form::end();
