<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use WebSupportDK\PHPHttp\Url;
use App\Exceptions\Handler;

class ErrorsController extends Controller
{

	// variable for storing view data
	public $data;

	/**
	 * Construct this object by extending the base Controller class and view
	 */
	public function __construct()
	{
		// construct Controller
		parent::__construct();
	}

	public function index($code = 404)
	{
		$this->View->render(array(
			"errors/{$code}"
			));
	}

	public function code($code)
	{
		$this->View->render(array(
			"errors/{$code}"
			), array('url' => Url::getPrevious()));
	}

	public function exception($message)
	{
		$test = false;
		try {
			if (!$test):
				throw new Handler($test);
			endif;
		} catch (Handler $ex) {
			e($ex->exception($message));
			error_log($ex->exception($message));
		}
	}
}
