<?php
use WebSupportDK\PHPHtml\Form;
use WebSupportDK\PHPHttp\Url;

?>
<h1>Your tasks (<small><a href="<?php e(APP_URL) ?>new">New task</a></small>)</h1>
<ul>
		<?php foreach ($this->Data->Post as $post): ?>
		<li>
	<?php Form::start(Url::get(), 'post') ?>
			<input
				type="checkbox"
				onclick="this.form.submit()"
			<?php e($post->ID) ? 'checked' : ' ' ?> />
			<input type="hidden" name="item" value="<?php e($post->ID) ?>" />
			<?php e($post->Title) ?> 
			<small><a href="<?php e(APP_URL) ?>task/delete"> (X)</a></small>
	<?php Form::end() ?>

		</li>
<?php endforeach ?>
</ul>
<a href="<?php e(APP_URL) ?>auth/logout">Log out</a>