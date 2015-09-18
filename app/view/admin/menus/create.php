<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_CREATE', false);
    ?></h2> 
<?php
Form::start($this->current_url, 'post');

Form::label('label', 'Navn', "class='control-label' required");
Form::input('text', 'label', null, " class='form-control' required");

Form::label('name', 'URL', "class='control-label'");
Form::input('text', 'name', null, " class='form-control' required");

Form::label('sort', 'Rækkefølge', "class='control-label' required");
Form::input('number', 'sort', null, " class='form-control'");

Form::label('type', 'Type', "class='control-label'");
?>
<select name="type" id="type" class="form-control">
    <option value="header">Header menu</option>
    <option  value="footer">Footer menu</option>
</select>
<?php
Form::input('hidden', 'current_url', $this->current_url, 'required');
Form::space();

Form::submit('submit', I18n::get('POSTS_SAVE'), "class='form-control btn-success'");
Form::end();
