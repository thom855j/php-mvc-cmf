<?php
/** 
 * Error controller
 */
use WebSupportDK\PHPMvcFramework\Controller;

class ErrorController extends Controller{

	function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		
	}
	
	public function code($int)
	{
		echo "ERROR: {$int}";
	}
}

