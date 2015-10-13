<?php
/*
 * Page Controller
 */
namespace App\Controllers;

use WebSupportDK\PHPMvcFramework\Controller;
use WebSupportDK\PHPHttp\Url;
use App\Models\PostsModel;

class PagesController extends Controller
{

	public $data;

	public function __construct()
	{
		parent::__construct();
		//$this->data['App'] = $this->App;
		$this->data['App'] = $this->App->get('config')->app;
		$this->data['layouts'] = $this->App->get('config')->view->layouts;
		$this->data['templates'] = $this->App->get('config')->view->templates;

	}

	public function index()
	{
		Url::redirect(Url::getRoot('public'). 'pages/name/home');
	}

	public function id($ID)
	{
		
	}

	public function name($uri = 'home')
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

		$this->View->render($this->data['layouts'], $this->data);
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
		$layouts = (array) $this->data['layouts'];

		if (in_array($post->Name, $this->data['templates'])):
			$template = array_search($post->Name, $this->data['templates']);
			$index = array_search('index', $layouts);
			$layouts[$index] = $this->data['templates'][$template];
			$this->data['layouts'] = $layouts;
		endif;
	}
}
