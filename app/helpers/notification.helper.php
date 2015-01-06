<?php

class Notifications {

	/**
	 * Set a notice
	 *
	 * @param string message
	 * @return void
	 **/
	public static function notice($message)
	{
		if (!isset($_SESSION['notice']))
			$_SESSION['notice'] = array();
		array_push($_SESSION['notice'], $message);
	}

	/**
	 * Set an alert
	 *
	 * @param string message
	 * @return void
	 **/
	public static function alert($message)
	{
		if (!isset($_SESSION['alert']))
			$_SESSION['alert'] = array();
		array_push($_SESSION['alert'], $message);
	}

	/**
	 * Show notifications
	 *
	 * @return void
	 **/
	public static function show()
	{
		if (isset($_SESSION['alert'])) {
			foreach ($_SESSION['alert'] as $alert) : ?>
				<div class="col-xs-12">
					<div class="alert alert-danger"><?=$alert?></div>
				</div>
			<?php endforeach;
		}
		if (isset($_SESSION['notice'])) {
			foreach ($_SESSION['notice'] as $notice) : ?>
				<div class="col-xs-12">
					<div class="alert alert-success"><?=$notice?></div>
				</div>
			<?php endforeach;
		}
		unset($_SESSION['notice']);
		self::clear();
	}

	/**
	 * Clears notifications
	 *
	 * @return void
	 **/
	public static function clear()
	{
		unset($_SESSION['notice']);
		unset($_SESSION['alert']);
	}

}