<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_UPDATE', false);
    ?></h2> 
<?php
foreach ($this->results->options as $view)
{
    Form::start($this->current_url, 'post');

    Form::label('editor', $view->Label, "class='control-label'");
    Form::textarea('editor', " class='form-control'", $view->Value);

    Form::input('hidden', 'ID', $view->ID);
    Form::input('hidden', 'current_url', $this->current_url, 'required');
    Form::space();

    Form::submit('submit', I18n::get('POSTS_SAVE'), "class='form-control btn-success'");
    Form::end();
}