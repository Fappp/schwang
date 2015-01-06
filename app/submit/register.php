<?php

// Used for registrations

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
					redirect('/settings/users');
				} else {
					Notifications::alert('That email address has been used already');
					redirect('/settings/users');
				}
			} else {
				Notifications::alert('Please enter a name');
				redirect('/settings/users');
			}
		} else {
			Notifications::alert('Please enter a password');
			redirect('/settings/users');
		}
	} else {
		Notifications::alert('Please enter a valid email address');
		redirect('/settings/users');
	}
} else {
	Notifications::alert('Please enter an email address');
	redirect('/settings/users');
}