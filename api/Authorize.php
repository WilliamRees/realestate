<?php
	include_once '../../includes/WebSecurity.php';
	include_once '../ApiResult.php';
	include_once '../../includes/config.php';

	WebSecurity::sec_session_start();

	if (WebSecurity::isAuthenticated($mysqli) != true) {
		header("Location: " . SITE_ROOT . 'secure/login');
		$result = new ApiResult(false, SITE_ROOT . 'secure/login');
		echo json_encode($result);
		exit;
	}
?>