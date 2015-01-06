<?php

// Used for registrations

// new-email
// new-password
// new-name

// Grab submitted data
$email = isset($_POST['new-email']) ? $_POST['new-email'] : '';
$password = isset($_POST['new-password']) ? $_POST['new-password'] : '';
$name = isset($_POST['new-name']) ? $_POST['new-name'] : '';

redirectIfLoggedOut();

// Register user
if ($email != '') {
	// Email isn't blank
	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Email is valid
		if ($password != '') {
			// Password isn't blank
			if ($name != '') {
				// Name isn't blank
				if (!Users::emailUsed($email)) {
					// Email isn't used
					Users::register($email, $password, $name);
					Notifications::notice('User created');
					redirect('/');
				} else {
					Notifications::alert('That email address has been used already');
					redirect('/');
				}
			} else {
				Notifications::alert('Please enter a name');
				redirect('/');
			}
		} else {
			Notifications::alert('Please enter a password');
			redirect('/');
		}
	} else {
		Notifications::alert('Please enter a valid email address');
		redirect('/');
	}
} else {
	Notifications::alert('Please enter an email address');
	redirect('/');
}