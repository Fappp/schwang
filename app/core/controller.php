<?php
/**
 * @package shwang
 * @author Nik Sudan
 */

class Controller
{
	protected $type;
	protected $view;
	protected $param;
	public $data = [];
	public $url;

	/**
	 * Initialises the controller
	 * @since 1.0
	 * 
	 * @param string $type Controller type
	 */
	public function __construct( $type )
	{
		// Assign controller type for reference
		$this->type = $type;

		// Load models
		foreach ( DirectoryHelper::load( '/app/models' ) as $resource ) {
			$model = substr( $resource, 0, -4 );
			$class = ucwords( $model ) . 'Model';
			$this->{$model} = new $class();
		}

		// Get URL element
		global $url;
		$this->view = strtolower( $url->shift() );
		$this->url = $url;

		// Default to index if none was specified
		if ( empty( $this->view ) ) {
			$this->view = 'index';
		}

		// Execute view logic
		$fn = $this->view;
		$object = ucwords( $type ) . 'Controller';

		if ( method_exists( $object, $fn ) ) {
			$this->$fn();

		// Couldn't find logic, check index
		} elseif ( method_exists( $object, 'index' ) ) {
			array_unshift( $this->url, $this->view );
			$this->view = 'index';
			$this->index();

		// Index isn't defined, so throw a 404
		} else {
			show_404();
		}
	}

	/**
	 * Renders a view
	 * @since 1.0
	 * 
	 * @param string $view View name
	 */
	public function render( $view = null )
	{
		if ( $view == null ) {
			$view = $this->view;
		}

		// Map data variables
		foreach ( $this->data as $index => $var ) {
			global ${$index};
			${$index} = $var;
		}

		// IndexController ignores view subfolder
		if ( $this->type == 'index' ) {
			$path = 'app/views/' . $view . '.phtml';

		// Everything else doesn't
		} else {
			$path = 'app/views/' . $this->type . '/' . $view . '.phtml';
		}

		// Load if exists
		if ( file_exists( $path ) ) {

			// Load header
			require 'app/views/header.phtml';

			require $path;

			// Load footer
			require 'app/views/footer.phtml';

		// Couldn't find view
		} else {
			show_404();
		}
	}

	/**
	 * Redirect to another page
	 * @since 1.0
	 * 
	 * @param string $location URL of target page
	 */
	public function redirect( $location )
	{
		header( 'Location: ' .  $location );
		die();
	}

	/**
	 * Reload the page
	 * @since 1.0
	 */
	public function refresh()
	{
		$this->redirect( $_SERVER['REQUEST_URI'] );
	}
}