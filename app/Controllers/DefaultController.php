<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Exceptions\Handler;

class DefaultController extends Controller
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

	public function index()
	{
		$this->View->render(array(
			'home'
			), $this->App);
	}

	public function error($message = 'Hello World')
	{
		$test = false;
		try {
			if (!$test):
				throw new Handler($test);
			endif;
		} catch (Handler $ex) {
			error_log($ex->exception($message));
		}
	}
}
