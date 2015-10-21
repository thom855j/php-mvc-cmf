<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Http\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Exceptions\Handler;

use WebSupportDK\PHPHttp\Input;
use WebSupportDK\PHPSecurity\Token;

class AuthController extends Controller
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

		return redirect('auth/login');
	}

	public function login()
	{
		return view('auth/login');
	}

	public function verify()
	{

		if(Input::exists('post') && Token::check('csrf_token', Input::get('csrf_token'))){
		$login = app('Auth')->login(
			Input::get('username'),
			Input::get('password'), 
			Input::get('remember')
			);

			if($login)
			{
				redirect();
			}
		}

	}

	public function logout()
	{
		app('Auth')->logout();
	}

	public function reset()
	{
		return view('auth/reset');
	}

	

}
