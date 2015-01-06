<?php

// =======================================
// Miscellaneous Functions
// =======================================

/**
 * Page declaration
 *
 * @return void
 **/
function page()
{
	if ( !defined( 'ABSPATH' ) ) exit;
	Notifications::show();
}

/**
 * Part inclusion
 *
 * @param string name
 * @return void
 **/
function part($name)
{
	include ROOTDIR.'/app/parts/'.$name.'.php';
}

/**
 * Form declaration
 *
 * @param params
 * @return void
 **/
function form_init($action, $method = 'post', $classes = 'well')
{
	?><form action="../submit/<?= $action ?>" method="<?= $method ?>" role="form" class="<?= $classes ?>"><?php
}

/**
 * Return a snippet of the string
 *
 * @param string original text
 * @param int start position
 * @param int end position
 * @return string snippeted string
 **/
function getSnippet($text, $start, $end)
{
	$offset = strlen($start);
	$str = substr( $text, strpos($text, $start)+$offset );
	return htmlentities(substr( $str, 0, strpos($str, $end) ));
}

/**
 * Returns an encrypted value
 *
 * @param string value
 * @return string encrypted value
 **/
function encrypt($value)
{
	return md5(hash("sha512", md5($value)));
}

/**
 * Return a random greeting
 *
 * @return string greeting
 **/
function greeting()
{
	$greetings = array(
		'Hey',
		'Hi',
		'Yo',
		'Wassup',
		'Hello',
		'Hiya',
		'Heyo',
		'Sup',
		'Welcome'
	);
	return $greetings[array_rand($greetings, 1)];
}

/**
 * Get date difference from the time now
 *
 * @param datetime date
 * @return string formatted string
 **/
function dateDifference($date)
{
	$start_date = new DateTime($date);
	$now = new DateTime(date('r'));
	$diff = $start_date->diff(new DateTime(date('r')));
	if ($diff->y > 0)
		return $diff->y.' year'.($diff->y == 1 ? '' : 's');
	else if ($diff->m > 0)
		return $diff->m.' month'.($diff->m == 1 ? '' : 's');
	else if ($diff->d > 0)
		return $diff->d.' day'.($diff->d == 1 ? '' : 's');
	else if ($diff->h > 0)
		return $diff->h.' hour'.($diff->h == 1 ? '' : 's');
	else if ($diff->i > 0)
		return $diff->i.' minute'.($diff->i == 1 ? '' : 's');
	else
		return $diff->s.' second'.($diff->s == 1 ? '' : 's');
}