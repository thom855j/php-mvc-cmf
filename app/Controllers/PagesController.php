<?php
/*
 * Page Controller
 */
use WebSupportDK\PHPMvcFramework\Controller;
use WebSupportDK\PHPHttp\Url;
use Models\PostsModel;

class PagesController extends Controller
{

	public $data;

	public function __construct()
	{
		parent::__construct();
		//$this->data['App'] = $this->App;
		$this->data['Site'] = $this->App->get('config')->site;
		$this->data['Theme'] = $this->App->get('theme')->Locale->{APPLOCALE};
		$this->data['Template Files'] = $this->App->get('theme')->{'Template Files'};
		$this->data['Custom Files'] = $this->App->get('theme')->{'Custom Files'};
	}

	public function index()
	{
		Url::redirect(Url::getRoot('public'). 'pages/name/'.APP_DEFAULT_PAGE);
	}

	public function id($ID)
	{
		
	}

	public function name($uri = APP_DEFAULT_PAGE)
	{
		$uri = implode('/', func_get_args());
		$this->_getPost($uri);
	}

	private function _getPost($uri)
	{
		$name = $this->_checkUrl($uri);
		$post = PostsModel::load()->getPageByName($name);

		$this->_dataExists($post);
		$this->_pageExists($post[0]);

		$this->data['Data'] = (object) array('Post' => $post[0]);
		//$this->data['Data'] = (object) array('Category'=> $category);

		$this->View->render($this->data['Template Files'], $this->data);
	}

	public function category()
	{
		
	}

	private function _dataExists($post)
	{
		if (empty($post)) :
			return http_response_code(404);
		endif;
	}

	private function _checkUrl($url)
	{
		if (empty($url)):
			return Url::redirect(Url::getRoot('public'));
		endif;
		return filter_var($url, FILTER_SANITIZE_URL);
	}

	private function _pageExists($post)
	{
		$templates = (array) $this->data['Template Files'];

		if (in_array($post->Name, $this->data['Custom Files'])):
			$custom = array_search($post->Name, $this->data['Custom Files']);
			$index = array_search('index', $templates);
			$templates[$index] = $this->data['Custom Files'][$custom];
			$this->data['Template Files'] = $templates;
		endif;
	}
}
