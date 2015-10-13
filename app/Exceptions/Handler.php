<?php
/*
 * Exceptions handler
 */
namespace Exceptions;

class Handler extends Exception
{

	public function errorMessage($message = '')
	{
		//error message
		$errorMsg = 'Error on line ' . $this->getLine() . ' in ' . $this->getFile()
			. ': <b>' . $this->getMessage() . "</b> $message";
		return $errorMsg;
	}
}
