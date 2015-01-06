<?php

// schwang
// Nik Sudan 2015
// v0.1
// https://github.com/NikSudan/schwang

// =======================================
// Constants
// =======================================

// Prevents direct access
define('ABSPATH', true);

// Root directory
define('ROOTDIR', __DIR__);

require_once('app/options.php');

// =======================================
// Session
// =======================================

session_start();

// =======================================
// Database
// =======================================

// Start connection
global $con;
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_TABLE);

// Database errors
if (mysqli_connect_errno()) {
	die(sprintf('<h1>Database Error</h1><p>%s</p>', mysqli_connect_error()));
}

// =======================================
// Libraries
// =======================================

/**
 * Returns array of php files
 *
 * @param string directory
 * @return array filenames
 **/
function getParts($dir) {
	$parts = (scandir(ROOTDIR.$dir));
	$validParts = array();
	foreach ($parts as $part) {
		if (strpos($part, '.php') !== FALSE) {
			array_push($validParts, str_replace('.php', '', $part));
		}
	}
	return $validParts;
}

// Classes
$classes = getParts('/app/classes');
foreach ($classes as $class) {
	include 'app/classes/'.$class.'.php';
}

// Functions
$functions = getParts('/app/functions');
foreach ($functions as $function) {
	include 'app/functions/'.$function.'.php';
}

// Helpers
$helpers = getParts('/app/helpers');
foreach ($helpers as $helper) {
	include 'app/helpers/'.$helper.'.php';
}

// =======================================
// URL Structure
// =======================================

// URL parts
global $elements;
$elements = preg_split('/(\/|\?)/', ltrim($_SERVER['REQUEST_URI'], '/'));
foreach ($elements as $i => $e) {
	if ($e == '') unset($elements[$i]);
}
$elements = array_values($elements);

global $currentPage;
$currentPage = Pages::get('home');

// =======================================
// User Update
// =======================================

LoggedUser::updateLastOnline();

// =======================================
// Reset System
// =======================================

// Eshots::reset();
// Users::reset();
// Settings::reset();

// Settings::set('site_name', 'EShot Manager');
// Settings::set('date_format', 'dS M Y H:i:s');
// Settings::set('admins', '1');
// Settings::set('status_change_emails', '');

// =======================================
// Form Submission
// =======================================

if ($currentPage == 'submit') {

	$page = Pages::get('404');
	Notifications::clear();

	if (in_array($page, getParts('/app/submit'))) {
		require(ROOTDIR.'/app/submit/'.$page.'.php');
	} else {
		Pages::show('404');
	}

}

// =======================================
// Page Content
// =======================================

include 'app/parts/header.php';

if (in_array($currentPage, getParts('/app/views')))
	Pages::show($currentPage);
else
	Pages::show('404');

include 'app/parts/footer.php';