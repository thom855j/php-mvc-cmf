<?php
namespace App\Services\Twig;
use Twig_Environment;
use Twig_Loader_Filesystem;

class View 
{
	protected $twig;

	public function __construct()
	{
		$this->twig = new Twig_Environment(
			new Twig_Loader_Filesystem(APP_VIEW)
		);
	}

	public function render($view, array $data = array())
	{
		return $this->twig->render($view, $data);
	}
}