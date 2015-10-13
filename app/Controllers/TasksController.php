<?php
/*
 * Default controller for frontend rendering of views
 * @author Thomas Elvin
 */
// use folllowing classes
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use App\Models\PostsModel;

class TasksController extends Controller
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
		$this->data['App'] = $this->App->get('config')->app;
	}

	public function index()
	{
	}
	
	public function view(){
			$task = PostsModel::load()->get(null,array(array('Type', '=', 'task')));
		$this->data['Data'] = (object) array('Post' => $task);
		$this->View->render(array(
			'layouts/header',
			'home',
			'layouts/footer'
		), $this->data);
	}
}
