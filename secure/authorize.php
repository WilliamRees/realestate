<?php
	include_once '../../includes/WebSecurity.php';
	include_once '../../includes/config.php';

	WebSecurity::sec_session_start();

	if (WebSecurity::isAuthenticated($mysqli) != true) {
		header("Location: " . SITE_ROOT . '/secure/login');
		exit;
	}
?>