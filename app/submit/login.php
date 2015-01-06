<?php

// Used for logins

// email
// password

redirectIfLoggedIn();

// Grab submitted data
$email = isset($_POST['email']) ? $_POST['email'] : '';
$password = isset($_POST['password']) ? $_POST['password'] : '';
if ($email != '') {
	// Email isn't blank
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Email is valid
		if ($password != '') {
			$password = encrypt($password);
			if (Users::emailUsed($email)) {
				$user = Users::getBy('email', $email);
				if ($user['password'] == $password) {
					login($email);
					Notifications::notice('You logged in successfully');
					redirect('/');
				} else {
					Notifications::alert('Incorrect password');
					redirect('/login');
				}
			} else {
				Notifications::alert('That account doesn\'t exist');
				redirect('/login');
			}
		} else {
			Notifications::alert('Please enter a password');
			redirect('/login');
		}
	} else {
		Notifications::alert('Please enter a valid email address');
		redirect('/login');
	}
} else {
	Notifications::alert('Please enter an email address');
	redirect('/login');
}