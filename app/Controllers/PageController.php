<?php
/*
 * Page Controller
 */
use WebSupportDK\PHPMvcFramework\Controller;
use Models\Pages\PageModel;

class PageController extends Controller
{

	public $data;
	private $_info;

	public function __construct()
	{
		parent::__construct();
		$this->_info['app_theme'] = PATH_APP_VIEWS_THEMES . APP_THEME;
		$this->_info['app_header'] = PATH_APP_VIEWS_THEMES . APP_THEME . '/assets/inc/_header';
	}

	public function index()
	{
		
	}

	public function id($ID)
	{
		
	}

	public function name($name = 'welcome')
	{
		$model = new PageModel();

		$page = $model->getName($name);

		if (empty($page)) {
			return http_response_code(404);
		}
		$this->data['page'] = $page[0];
		$this->View->render(array(
			$this->_info['app_header'],
			$this->_info['app_theme'] . '/index'
			), $this->data);
	}
}
