<?php

class Settings {

	/**
	 * Resets setting table
	 *
	 * @return void
	 **/
	public static function reset()
	{
		global $con;
		mysqli_query($con, "DROP TABLE settings");
		$query = "
		CREATE TABLE `settings` (
			`name` varchar(255) NOT NULL,
			`value` varchar(255) NOT NULL,
			PRIMARY KEY (`name`)
		) ;
		";
		mysqli_query($con, $query);
	}

	/**
	 * Sets setting
	 *
	 * @param params
	 * @return void
	 **/
	public static function set($name, $value)
	{
		global $con;
		self::remove($name);
		mysqli_query($con, "INSERT INTO settings VALUES ('$name', '$value');");
	}

	/**
	 * Returns all settings
	 *
	 * @return array settings
	 **/
	public static function getAll()
	{
		global $con;
		$settings = array();
		$result = mysqli_query($con, "SELECT * FROM settings");
		while($row = mysqli_fetch_array($result)) {
		    $settings[] = $row;
		}
		return $settings;
	}

	/**
	 * Returns setting
	 *
	 * @param string name
	 * @return string value
	 **/
	public static function get($name)
	{
		global $con;
		$result = mysqli_query($con, "SELECT * FROM settings WHERE name='$name'");
		$result = mysqli_fetch_array($result);
		return $result['value'];
	}

	/**
	 * Remove setting
	 *
	 * @param string name
	 * @return void
	 **/
	public static function remove($name)
	{
		global $con;
		mysqli_query($con, "DELETE FROM settings WHERE name='$name';");
	}

}