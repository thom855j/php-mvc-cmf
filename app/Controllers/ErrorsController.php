<?php
/** 
 * Error controller
 */
namespace App\Controllers;
use WebSupportDK\PHPMvcFramework\Controller;

class ErrorsController extends Controller{

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

