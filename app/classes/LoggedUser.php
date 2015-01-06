<?php

class LoggedUser {

	/**
	 * Returns current user's details
	 *
	 * @param string property
	 * @return void
	 **/
	public static function get($property = null)
	{
		if ($property == null) {
			return Users::getBy('email', $_SESSION['user']['email']);
		} else {
			return loggedIn() ? htmlentities($_SESSION['user'][$property]) : null;
		}
	}

	/**
	 * Returns if current user is an admin
	 *
	 * @return boolean
	 **/
	public static function isAdmin()
	{
		$admins = Users::getAdmins();
		return (in_array(self::get('id'), $admins)) ? true : false;
	}

	/**
	 * Updates the user's last online time
	 *
	 * @return void
	 **/
	public static function updateLastOnline()
	{
		if (loggedIn()) {
			Users::update(self::get('id'), 'last_online', date('r'));
		}
	}

}
