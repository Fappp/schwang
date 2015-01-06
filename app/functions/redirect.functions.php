<?php

// =======================================
// Redirect Related Functions
// =======================================

/**
 * Redirects to another page
 *
 * @param string url
 * @return void
 **/
function redirect($destination)
{
	echo sprintf('<META http-equiv="refresh" content="0;URL=%s">', $destination);
	die();
}

/**
 * Redirect if logged in
 *
 * @param params
 * @return void
 **/
function redirectIfLoggedIn($page = '/schedule')
{
	if (loggedIn()) {
		redirect($page);
	}
}

/**
 * Redirect if logged out
 *
 * @param string page
 * @return void
 **/
function redirectIfLoggedOut($page = '/login')
{
	if (!loggedIn()) {
		Notifications::alert('You need to be logged in to do that');
		redirect($page);
	}
}

/**
 * Redirect if not admin
 *
 * @param string page
 * @return void
 **/
function redirectIfNotAdmin($page = '/schedule')
{
	redirectIfLoggedOut();
	if (!LoggedUser::isAdmin()) {
		Notifications::alert('You do not have permission for that');
		redirect($page);
	}
}