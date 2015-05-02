<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

class UrlParser
{
	private $segments = [];

	/**
	 * Initialise URL parts
	 * @since 1.0
	 */
	public function __construct()
	{
		// Parse segments from URL
		$this->segments = preg_split( '/(\/|\?)/', ltrim( $_SERVER['REQUEST_URI'], '/' ) );

		// Eliminate any blank entries
		foreach ( $this->segments as $index => $part ) {
			if ( $part == '' ) {
				unset( $this->segments[$index] );
			}
		}

		// Set to array values
		$this->segments = array_values( $this->segments );
	} 

	/**
	 * Shift off the current URL segment
	 * @since 1.0
	 * 
	 * @return string Url segment
	 */
	public function shift()
	{
		// Return false if no more parts or current part is blank
		if ( count( $this->segments ) == 0 || $this->segments[0] == '' ) {
			return false;
		}

		// Shift off next URL part
		return array_shift( $this->segments );
	}

	/**
	 * Get the current URL segments
	 * @since 1.0
	 * 
	 * @return array URL segments
	 */
	public function get_segments()
	{
		return $this->segments;
	}
}