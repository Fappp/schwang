<?php

class Pages {

	/**
	 * Shows the desired page
	 *
	 * @param string page
	 * @param string directory
	 * @return void
	 **/
	public static function show($page, $dir = 'views')
	{
		include sprintf(ROOTDIR.'/app/%s/%s.php', $dir, $page);
	}

	/**
	 * Get current page to use
	 *
	 * @param string default
	 * @return string page
	 **/
	public static function get($default = 'home')
	{
		global $elements;
		return (count($elements) == 0 || $elements[0] == '') ? $default : array_shift($elements);
	}

	/**
	 * Get all remaining URL elements
	 *
	 * @return array elements
	 **/
	public static function elements()
	{
		global $elements;
		return $elements;
	}
	
}