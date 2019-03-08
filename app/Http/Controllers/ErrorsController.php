<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Http\Controllers;

use Datalaere\PHPMvcFramework\Controller;
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

	public function index()
	{
		
	return	$this->View->render(array(
			"errors/404"
			));
	}

	public function code($code)
	{

		if(file_exists(APP_VIEW . "errors/{$code}.php")){

		return $this->View->render(array(
			"errors/{$code}"
			), $this->data);
		}

		return redirect('errors/code/502');
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
