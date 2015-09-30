<?php
use WebSupportDK\PHPMvcFramework\Controller;

class HomeController extends Controller
{

	function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		echo 'I am home!';
	}
}
