<?php
// Get or set something to/from app
if (!function_exists('app')) { 

	function app($name, $value = null)
	{
		global $app;
		if(!is_null($value))
		{
			return $app->set($name, $value);
		}
		return $app->get($name);
	}
}

// Set env varibale from constant or use default string
if (!function_exists('env')) { 

	function env($constant, $string)
	{
	  return defined($constant) ? constant($constant) : $string;
	}
}

// Get a view from the resources folder
if (!function_exists('env')) { 

	function view($string)
	{
		req(APP_VIEW . $string);
	}
}

// Get something from config
if (!function_exists('config')) { 
	function config($string)
	{
		global $app;
		return $app->get("config.{$string}");
	}
}

// Get uploaded file
if (!function_exists('uploaded_file')) { 

	function uploaded_file($string)
	{
		return APP_UPLOAD . $string;
	}	
}

// Return locale lang
if (!function_exists('locale')) { 

	function locale()
	{
		return APP_LOCALE;
	}
}

// Translate a string
if (!function_exists('trans')) { 
	
	function trans($string)
	{
		global $app;
		return $app->get($string);
	}
}

// Return app charset
if (!function_exists('charset')) { 
	
	function charset()
	{
		return APP_CHARSET;
	}
}

// Die and dump object
if (!function_exists('dd')) { 
	
	function dd($object)
	{
		echo '<pre>';
		var_dump($object);
		echo '</pre>';
		die;
	}
}


// Redirect http errors
if (!function_exists('http_error_handler')) { 

	function http_error_handler(){
	  /*
	  * Custom header errors handeling
	  */

	  switch (http_response_code())
	  {
	  case 404:
	    return redirect('errors/code/404/');
	    break;

	    case 500:
	    return redirect('errors/code/500');
	    break;

	  default:
	    break;
  		}
	}
}

// Return last visited url
if (!function_exists('http_referer')) { 

	function http_referer()
	{
		return Datalaere\PHPHttp\Url::getPrevious();
	}
}

// Redirect to string
if (!function_exists('redirect')) { 

	function redirect($string = null)
	{
		return Datalaere\PHPHttp\Url::redirect(Datalaere\PHPHttp\Url::getRoot('public') . $string);
	}
}

// Redirect back
if (!function_exists('back')) { 

	function back()
	{
		return redirect(http_referer());
	}
}

// Return current url
if (!function_exists('back')) { 

	function current_url(){
		return Datalaere\PHPHttp\Url::get();
	}
}

// Return current url (optionally with a path)
if (!function_exists('url')) { 
	
	function url($path = null){
		return Datalaere\PHPHttp\Url::getRoot('public') . $path;
	}
}

// Get an asset from the public url
if (!function_exists('asset')) { 

	function asset($path)
	{
		return APP_ASSET . $path;
	}
}

// Get a component from public url
if (!function_exists('component')) { 

	function component($path)
	{
		return APP_COMPONENT . $path;
	}
}


// print_r an object
if (!function_exists('pr')) { 

	function pr($object)
	{
		echo '<pre>';
		print_r($object);
		echo '</pre>';
		die;
	}
}

// Echo and escape string
if (!function_exists('e')) { 

	function e($string)
	{
		echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
	}
}

// Include a file
if (!function_exists('inc')) { 

	function inc($path)
	{
		include_once $path . '.php';
	}
}

// Require a file
if (!function_exists('req')) { 

	function req($path)
	{
		require_once $path . '.php';
	}
}

// Output runtime of app
if (!function_exists('rutime')) { 

	function rutime($ru, $rus, $index)
	{
		return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
	}
}

// Return storage page
if (!function_exists('storage')) { 

	function storage($path)
	{
		return APP_STORAGE . $path;
	}
}

if (!function_exists('csrf_token')) { 
	
	function csrf_token($key){
		return Datalaere\PHPSecurity\Token::generate($key);
	}
}
