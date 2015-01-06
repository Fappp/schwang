<?php

// Used for editing settings

redirectIfLoggedOut();
redirectIfNotAdmin();

Settings::set($_POST['field'], $_POST['value']);
Notifications::notice('Updated setting');

redirect('/settings');