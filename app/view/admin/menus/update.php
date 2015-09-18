<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"><?php
    I18n::get('POSTS_UPDATE', false);
    ?></h2> 
<?php
foreach ($this->results->menu as $view)
{
    Form::start($this->current_url, 'post');

    Form::label('label', 'Navn', "class='control-label' ");
    Form::input('text', 'label', $view->Label," class='form-control' required");

    Form::label('name', 'URL', "class='control-label'");
    Form::input('text','name', $view->Name," class='form-control' required");

    Form::label('sort', 'Rækkefølge', "class='control-label'");
    Form::input('number','sort',$view->Sort, " class='form-control' required");
    
    Form::input('hidden', 'ID', $view->ID);
    Form::input('hidden', 'current_url', $this->current_url, 'required');
    Form::space();

    Form::submit('submit', I18n::get('POSTS_SAVE'), "class='form-control btn-success'");
    Form::end();
}