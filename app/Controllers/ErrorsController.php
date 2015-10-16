<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
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
		$this->data['url'] = get_http_referer();
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
		
		return http_redirect_to('errors/code/500');
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
