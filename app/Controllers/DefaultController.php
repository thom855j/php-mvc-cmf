<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
use WebSupportDK\PHPMvcFramework\Controller;
use Models\Pages\PageModel;

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
		print_r($this);
	}


}
