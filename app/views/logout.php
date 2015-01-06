<?php if ( !defined( 'ABSPATH' ) ) exit;
logout();
clearNotifications();
setNotice('Logged out');
redirect('/login');