<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_UPDATE', false);
    ?></h2>
<?php
foreach ($this->results->posts as $view)
{
    Form::start($this->current_url, "post");
    Form::label('city', I18n::get('POSTS_CITY'), "class='control-label'");
    Form::input('text', 'city', $view->City, "class='form-control' required");

    Form::label('country', I18n::get('POSTS_COUNTRY'), "class='control-label'");
    Form::input('text', 'country', $view->Country, "class='form-control' required");

    Form::label('type', I18n::get('POSTS_TYPE'), "class='control-label' required");
    ?>
    <p>Nuværende type: <?php echo "'$view->Type'" ?></p>
    <select class="form-control" name="type" id="type" required>
        <option value="Hus">Hus</option>
        <option value="Lejlighed">Lejlighed</option>
    </select>
    <?php
    Form::label('content', I18n::get('POSTS_CONTENT'), "class='control-label'");
    Form::textarea('content', " class='form-control' required", $view->Content);

    Form::label('excerpt', I18n::get('POSTS_EXCERPT'), "class='control-label'");
    Form::textarea('excerpt', " class='form-control' required", $view->Excerpt);

    Form::label('rooms', I18n::get('POSTS_ROOMS'), "class='control-label'");
    Form::input('number', 'rooms', $view->Rooms, "class='form-control' required");

    Form::label('m2', I18n::get('POSTS_M2'), "class='control-label'");
    Form::input('number', 'm2', $view->M2, "class='form-control' required");

    Form::label('bath_rooms', I18n::get('POSTS_BATHROOMS'), "class='control-label'");
    Form::input('number', 'bath_rooms', $view->Bath_rooms, "class='form-control' required");

    Form::label('price', I18n::get('POSTS_PRICE'), "class='control-label' required");
    Form::input('number', 'price', $view->Price, "class='form-control'");


    Form::label('status', I18n::get('POSTS_STATUS'), "class='control-label'");
    ?>
    <p>Nuværende status: <?php echo "'$view->Label'" ?></p>
    <select class="form-control" name="status" id="status">
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
            $thumbnail_selected = '';
            $gallery_selected   = '';
            $thumb              = $upload_path . 'thumbs/' . $upload->Slug;
            $source             = $upload_path . 'source/' . $upload->Slug;

            if (isset($this->results->upload_items))
            {
                foreach ($this->results->upload_items as $upload_item)
                {

                    if ($upload_item->Item_ID == $upload->ID)
                    {
                        $gallery_selected = "selected ";
                    }
                }
            }

            if ($view->Thumbnail == $upload->Slug)
            {
                $thumbnail_selected = "selected ";
            }

            $uploads[] = Form::options($upload->ID, $source, $gallery_selected . "data-img-src='$thumb'");

            $thumbnail[] = Form::options($upload->Slug, $source, $thumbnail_selected . "data-img-src='$thumb'");
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
                        <h4 class="modal-title"><?php I18n::get('POSTS_THUMBNAIL', false) ?></h4>
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
        Form::label('upload', I18n::get('POSTS_MEDIA'), "class='control-label'");
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

    Form::input('hidden', 'ID', $view->ID);
    Form::submit('submit', I18n::get('POSTS_SAVE'), "class='form-control btn-success'");
    Form::end();
}