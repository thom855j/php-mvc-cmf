<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Services\PDF\Capture;

class TestController extends Controller
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
	$capture = new Capture;
	$capture->load('invoice/default.php',[
		'order' => 1231
	]);
	}

}
