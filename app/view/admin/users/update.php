<?php

use thom855j\PHPMultilingual\I18n,
    thom855j\PHPHtml\Form;
?>
<h2 class="sub-header">Bruger info</h2> 
<?php

foreach ($this->results->data as $user)
{
    Form::start($this->project_url . 'users/update', "post");
    Form::label('username', 'Brugernavn', " class='control-label'");
    Form::input('text', 'username', $user->Username, "class='form-control' disabled");

    Form::label('full_name', 'Navn', " class='control-label'");
    Form::input('text', 'full_name', $user->Name, "class='form-control' disabled");

    Form::label('email', 'Email', " class='control-label'");
    Form::input('email', 'email', $user->Email, "class='form-control' disabled");

    Form::label('org', 'Firma', " class='control-label'");
    Form::input('text', 'org', $user->Org, "class='form-control' disabled");

    Form::input('hidden', 'ID', $user->ID);
    Form::input('hidden', 'current', $this->current_url);

    Form::end();
}