<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

// Website root directory
define( 'DIR', __DIR__ );

// Setup medoo framework for database interaction
require_once( '/lib/medoo.min.php' );
global $db;
$db = new medoo( [
    'database_type' 	=> 'mysql',
    'database_name' 	=> '',
    'server' 			=> '',
    'username' 			=> '',
    'password' 			=> '',
    'charset' 			=> 'utf8'
] );

// Load directory helper for core loading
require_once( '/app/core/directoryhelper.php' );

// Resource directories to load
$resources = [
	'/app/core',
	'/app/classes',
	'/app/helpers',
	'/app/models'
];
 
// Start a session for keeping track of various local user information
if ( !session_id() ) {
    session_start();
}

// Load resources
foreach ( $resources as $location ) {
	foreach ( DirectoryHelper::load( $location ) as $resource ) {
		include $location . '/' . $resource;
	}
}

// Parse the URL
global $url;
$url = new UrlParser();

// Figure out what controller to use
$controller = $url->shift();

// Fallback controller for homepage
if ( !$controller ) {
	$controller = 'index';
}

// Load the controller
$controllerPath = 'app/controllers/' . strtolower( $controller ) . '.php';

if ( file_exists( $controllerPath ) ) {
	require $controllerPath;
	$className = ucwords( $controller ) . 'Controller';
	$page = new $className( $controller );

// Controller doesn't exist, so show a 404
} else {
	show_404();
}