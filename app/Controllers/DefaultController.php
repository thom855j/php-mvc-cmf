<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Exceptions\Handler;
use Gears\Pdf;

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
		// Parse default data about app
		$this->data['App'] = $this->App;
	}

	public function index()
	{
	return $this->View->render(array(
			'home'
			), $this->data);
	}

	public function test()
	{
		$test = storage('framework/app/test.pdf');
		$pdf = Pdf::convert(APP_VIEW . 'test.html', $test);
		debug($pdf);
	}
}
