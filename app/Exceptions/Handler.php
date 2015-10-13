<?php
/*
 * Exceptions handler
 */
namespace App\Exceptions;

use Exception;

class Handler extends Exception
{

	public function exception($message = '')
	{
		//error message
		$errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
			. ': <b>' . $this->getMessage() . "</b> $message";
		return $errorMsg;
	}
}
