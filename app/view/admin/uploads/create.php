<?php
use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header"> 
    <?php 
    i18n::get( 'UPLOADS_CREATE',false) ; 
    ?> 
</h2> 
<?php 
Form::start( $this->current_url , "post" , true ) ; 

Form::label( 'file' , I18n::get( 'UPLOADS_FILE') , "class='control-label'" ) ; 
Form::input( 'file' , 'files[]' , null , "multiple class='form-control'" ) ; 

Form::space( 1 ) ; 

Form::submit( 'Gem' , I18n::get( 'POSTS_SAVE') ,  "class='form-control btn-success'" ) ; 
Form::end() ; 
