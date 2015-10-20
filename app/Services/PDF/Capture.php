<?php

namespace App\Services\PDF;

use App\Services\Twig\View;
use Symfony\Component\Process\Process;
use Symfony\Component\HttpFoundation\Response;

class Capture
{

	protected $view, $pdf;

	public function __construct()
	{
		$this->view = new View;
	}

	public function load($filename, array $data = array())
	{
		$view = $this->view->render($filename, $data);
		$this->pdf = $this->captureImage($view);
	}

	protected function captureImage($view)
	{
		$path = $this->writeFile($view);

		 $this->phantomProcess($path)->setTimeout(10)->mustRun();

		 return $path;
	}

	protected function writeFile($view)
	{
		file_put_contents($path = storage('framework/app/' . md5(uniqid()) . '.pdf' ), $view);
		return $path;
	}

	protected function phantomProcess($path)
	{

		return new Process(BASE_PATH . 'bin/phantomjs/phantomjs ' . BASE_PATH . 'public/assets/js/capture.js '  . $path);
	}

	public function respond($filename)
	{
		$response = new Response(file_get_contents($this->pdf), 200, array(
			'Content-Description' => 'File Transfer',
			'Content-Disposition' => 'attachment; filename="' . $filename .'"',
			'Content-Transfer-Encoding' => 'binary',
			'Content-Type' => 'application/pdf'
		));

		unlink($this->pdf);

		$response->send();
	}
}