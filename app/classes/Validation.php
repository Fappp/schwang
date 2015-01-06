<?php

class Validation {

	public $result = false;
	public $message = '';
	
	public function __construct($result, $message)
	{
		$this->result = $result;
		$this->message = $message;
	}
}