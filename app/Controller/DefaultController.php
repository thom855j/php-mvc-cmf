<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
use WebSupportDK\PHPMvcFramework\Controller;

class DefaultController extends Controller
{

	// variable for storing view data
	public $data = array();
	// varibale for storing controller info
	private $_info = array();

	/**
	 * Construct this object by extending the base Controller class and view
	 */
	private function __construct()
	{
		// construct Controller
		parent::__construct();
	}

	public function index()
	{
		//example
		var_dump($this);
	}
}
