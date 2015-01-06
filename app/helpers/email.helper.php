<?php

class Emails {

	/**
	 * Sends an email to an individual or multiple emails
	 *
	 * @param string email or array emails
	 * @param string subject
	 * @param string content
	 * @return void
	 **/
	public static function send($emails, $subject, $content)
	{
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: '.NOTIFICATION_NAME.'<'.NOTIFICATION_EMAIL.'>'.'\r\n';
		if (is_array($emails)) {
			foreach ($emails as $email) {
    			mail(trim($email), $subject, $content, $headers);
    		}
		} else {
			mail($email, $subject, $content, $headers);
		}
	 }

}