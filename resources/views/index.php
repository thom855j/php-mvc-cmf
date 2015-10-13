<?php
use WebSupportDK\PHPHtml\Form;
use WebSupportDK\PHPHttp\Url;
?>
<h1>Your tasks (<small><a href="<?php e(APP_URL) ?>new">New task</a></small>)</h1>
<ul>
	<li>
		<?php Form::start(Url::get(), 'post') ?>
		<input
			type="checkbox"
			onclick="this.form.submit()"
			<?php e($this->Data->Post->ID) ? 'checked' : ' ' ?>
			<?php e($this->Data->Post->Name) ?> 
			<small><a href="<?php e(APP_URL) ?>task/delete"> (X)</a></small>
		<?php Form::end() ?>
		
	</li>
</ul>
<a href="<?php e(APP_URL) ?>auth/logout">Log out</a>