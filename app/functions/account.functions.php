<?php

// =======================================
// Account Related Functions
// =======================================

/**
 * Check if logged in
 *
 * @return boolean
 **/
function loggedIn()
{
	return isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true ? true : false;
}

/**
 * Log in to an account
 *
 * @param string email
 * @return boolean
 **/
function login($email)
{
	if (!loggedIn()) {
		$_SESSION['loggedIn'] = true;
		$user = getUser($email);
		$user['password'] = '';
		$_SESSION['user'] = $user;
		unset($_SESSION['user']['password']);
		return true;
	} else {
		return false;
	}
}

/**
 * Log out user
 *
 * @return void
 **/
function logout()
{
	$_SESSION['loggedIn'] = false;
	unset($_SESSION['loggedIn']);
	unset($_SESSION['user']);
}