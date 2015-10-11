<?php

/**
 * Bootstrap common function and tags for views
 */
function vd($object)
{
	echo '<pre>';
	var_dump($object);
	echo '</pre>';
}

function pr($object)
{
	echo '<pre>';
	print_r($object);
	echo '</pre>';
}

function escape($string)
{
	return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function e($string)
{
	echo htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

function inc($path)
{
	include_once $path . '.php';
}

function req($path)
{
	require_once $path . '.php';
}

function rutime($ru, $rus, $index)
{
	return ($ru["ru_$index.tv_sec"] * 1000 + intval($ru["ru_$index.tv_usec"] / 1000)) - ($rus["ru_$index.tv_sec"] * 1000 + intval($rus["ru_$index.tv_usec"] / 1000));
}
