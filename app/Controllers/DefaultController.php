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
	public $data = array();
	// varibale for storing controller info
	private $_info = array();

	/**
	 * Construct this object by extending the base Controller class and view
	 */
	public function __construct()
	{
		// construct Controller
		parent::__construct();
		$this->_info['app_header'] = PATH_APP_VIEWS_THEMES . APP_THEME . '/assets/inc/_header';
		$this->_info['app_theme'] = PATH_APP_VIEWS_THEMES . APP_THEME . DIRECTORY_SEPARATOR;
	}

	public function index()
	{
		$this->data['test'] = array(0 => 'Hans', 1 => 'Poul');
		$this->View->render(array(
			$this->_info['app_header'],
			$this->_info['app_theme'] . 'index'
			), $this->data);
	}

	public function pages($name)
	{
		$page = new PageModel();
		$this->data['page'] = $page->get($name)[0];
		if (empty($this->data['page'])) {
			return http_response_code(404);
		}
		$this->View->render(array(
			$this->_info['app_header'],
			$this->_info['app_theme'] . 'index'
			), $this->data);
	}
}
