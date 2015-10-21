<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Http\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Exceptions\Handler;
use Knp\Snappy\Pdf;

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
		$bin =	BASE_PATH . 'vendor/bin/wkhtmltopdf-amd64';
		// Display the resulting pdf in the browser
// by setting the Content-type header to pdf
	$snappy = new Pdf();

	$snappy->setBinary($bin);
	$snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', BASE_PATH .'storage/bill-123.pdf');

	}
}
