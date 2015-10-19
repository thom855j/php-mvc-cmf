<?php
// Get or set something to/from app
function app($name, $value = null)
{
	global $app;
	if(!is_null($value))
	{
		return $app->set($name, $value);
	}
	return $app->get($name);
}

// Set env varibale from constant or use default string
function env($constant, $string)
{
  return defined($constant) ? constant($constant) : $string;
}

// Get a view from the resources folder
function view($string)
{
	req(APP_VIEW . $string);
}

// Get something from config
function config($string)
{
	global $app;
	return $app->get("config.{$string}");
}

function uploaded_file($string)
{
	return APP_UPLOAD . $string;
}

// Return locale lang
function locale()
{

	return APP_LOCALE;
}

// Translate a string
function trans($string)
{
	global $app;
	return $app->get($string);
}

// Return app charset
function charset()
{
	return APP_CHARSET;
}

// Die and dump object
function dd($object)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
	die;
}

// Just var_dump object
function vd($object)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
	exit;
}

// Redirect http errors
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

// Return last visited url
function http_referer()
{
	return WebSupportDK\PHPHttp\Url::getPrevious();
}

// Redirect to string
function redirect($string = null)
{
	return WebSupportDK\PHPHttp\Url::redirect(WebSupportDK\PHPHttp\Url::getRoot('public') . $string);
}

function back()
{
		return redirect(http_referer());
}

// Return current url
function current_url(){
	return WebSupportDK\PHPHttp\Url::get();
}

// Return current url
function url($path = null){
	return WebSupportDK\PHPHttp\Url::getRoot('public') . $path;
}

// Get an asset from the public url
function asset($path)
{
	return APP_ASSET . $path;
}

// Get a component from public url
function component($path)
{
	return APP_COMPONENT . $path;
}

// print_r an object
function pr($object)
{
	echo '<pre>';
	print_r($object);
	echo '</pre>';
	exit;
}

// Echo and escape string
function e($string)
{
	echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Include a file
function inc($path)
{
	include_once $path . '.php';
}

// Require a file
function req($path)
{
	require_once $path . '.php';
}

// Output runtime of app
function rutime($ru, $rus, $index)
{
	return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
}