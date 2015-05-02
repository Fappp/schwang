<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

/**
 * Template for 404 pages
 * @since 1.0
 * 
 * @return void
 */
function show_404()
{
	require 'app/views/header.phtml';
	require 'app/views/404.phtml';
	require 'app/views/footer.phtml';
	die();
}

/**
 * Die and dump
 * @since 1.0
 * 
 * @param variable $var
 * @return void
 */
function dd($var)
{
	echo '<pre>';
	var_dump($var);
	echo '</pre>';
	die();
}