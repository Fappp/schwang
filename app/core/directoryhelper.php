<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

if ( class_exists( 'DirectoryHelper' ) )
	return;

class DirectoryHelper
{
	/**
	 * Retrieve a listing of all files of type in a directory
	 * @since 1.0
	 *
	 * @param string $directory
	 * @param array $types Accepted file types
	 * @param boolean $extension Whether to remove the extension name
	 * 
	 * @return array File locations
	 */
	public static function load( $directory, $types = ['php'], $extension = false )
	{
		// Scan given directory
		$files = scandir ( DIR . $directory );
		$locations = [];
		
		// Cycle through directories
		foreach ( $files as $file ) {
			
			// Verify file type
			foreach ( $types as $type ) {
				if ( strpos( $file, '.' . $type ) !== FALSE ) {
					
					// Remove extension if necessary
					if ( $extension ) {
						$file = str_replace( '.' . $type, '', $file );
					}
					
					// Push result
					$locations[] = $file;
				}
			}
		}
		return $locations;
	}
}