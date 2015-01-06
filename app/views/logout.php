<?php if ( !defined( 'ABSPATH' ) ) exit;
logout();
Notifications::clear();
Notifications::notice('Logged out');
redirect('/login');