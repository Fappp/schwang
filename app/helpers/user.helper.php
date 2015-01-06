<?php

class Users {

	/**
	 * Resets user table
	 *
	 * @return void
	 **/
	public static function reset()
	{
		global $con;
		mysqli_query($con, "DROP TABLE users");
		$query = "
		CREATE TABLE `users` (
			`id` int(11) NOT NULL AUTO_INCREMENT,
			`email` varchar(255) NOT NULL,
			`password` varchar(255) NOT NULL,
			`name` varchar(255) NOT NULL,
			`created` varchar(255) NOT NULL,
			`updated` varchar(255) NOT NULL,
			`last_online` varchar(255) NOT NULL,
			PRIMARY KEY (`id`)
		) AUTO_INCREMENT=1 ;
		";
		mysqli_query($con, $query);
		self::register(ADMIN_EMAIL, ADMIN_PASSWORD, 'Admin');
		logout();
	}

	/**
	 * Get all users
	 *
	 * @return array users
	 **/
	public static function getAll()
	{
		global $con;
		$users = array();
		$result = mysqli_query($con, "SELECT * FROM users");
		while($row = mysqli_fetch_array($result)) {
		    $users[] = $row;
		}
		return $users;
	}

	/**
	 * Get a user
	 *
	 * @param int id
	 * @return void
	 **/
	public static function get($id)
	{
		return self::getBy('id', $id);
	}

	/**
	 * Get a user by a field
	 *
	 * @param string field
	 * @param string value
	 * @return array user
	 **/
	public static function getBy($field, $value)
	{
		global $con;
		$result = mysqli_query($con, "SELECT * FROM users WHERE $field='$value'");
		$user = mysqli_fetch_array($result);
		return $user;
	}

	/**
	 * Remove a user
	 *
	 * @param int id
	 **/
	public static function remove($id)
	{
		return self::removeBy('id', $id);
	}

	/**
	 * Remove a user by a field
	 *
	 * @param string field
	 * @param string value
	 **/
	public static function removeBy($field, $value) {
		global $con;
		$query = mysqli_query($con, "DELETE FROM users WHERE $field='$value'");
		mysqli_query($con, $query);
	}

	/**
	 * Register a user
	 *
	 * @param string email
	 * @param string password
	 * @param string name
	 * @return void
	 **/
	public static function register($email, $password, $name)
	{
		global $con;
		$password = encrypt($password);
		$name = addslashes($name);
		$created = date('r');
		$query = "INSERT INTO users VALUES ('', '$email', '$password', '$name', '$created', '$created', '$created');";
		mysqli_query($con, $query);
	}

	/**
	 * Updates a user
	 *
	 * @param int id
	 * @param string field
	 * @param string value
	 * @return void
	 **/
	public static function update($id, $field, $value)
	{
		self::updateBy('id', $id, $field, $value);
	}

	/**
	 * Updates a user by a field
	 *
	 * @param int id
	 * @param string field
	 * @param string value
	 * @return void
	 **/
	public static function updateBy($findField, $findValue, $field, $value)
	{
		global $con;
		if ($field != 'last_online') {
			$time = date('r');
			$query = "UPDATE users SET $field='$value',updated='$time' WHERE id='$id';";
		} else
			$query = "UPDATE users SET $field='$value' WHERE $findField='$findValue';";
		mysqli_query($con, $query);
	}

	/**
	 * Returns whether email address is used
	 *
	 * @param string email
	 * @return boolean
	 **/
	public static function emailUsed($email)
	{
		$users = self::getAll();
		foreach ($users as $user) {
			if ($user['email'] == $email)
				return true;
		}
		return false;
	}

	/**
	 * Get administrator accounts
	 *
	 * @return array admins
	 **/
	function getAdmins()
	{
		return Settings::get('admins');
	}

}