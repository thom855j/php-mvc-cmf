
<?php
/*
 * Compiler 
 */
$compiledPath = __DIR__.'/cache/compiled.php';

if(!file_exists($compiledPath)){
	$src = __DIR__.'/src/';
	$files = array(
		$src. 'start.php',
		$src .'helpers.php',
		$src .'config.php', 
		$src .'paths.php',
		$src .'constants.php',
		$src .'time.php',
		$src .'errors.php',
		$src .'session.php',
		$src .'time.php',
		$src .'language.php',
		$src .'view.php',
		$src .'cache.php',
		$src .'database.php',
		$src .'auth.php',
		$src .'mail.php',
		$src .'router.php',
		$src .'providers.php',
		$src .'app.php'
		);

    file_put_contents($compiledPath, '<?php');
    foreach($files as $file) {
        $content = file_get_contents($file);
        $compiled = preg_replace('/^<\?php(.*)(\?>)?$/s', '$1', $content);
        file_put_contents($compiledPath, $compiled, FILE_APPEND);
    }
}
