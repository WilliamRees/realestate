<?php
include_once 'WebSecurity.php';
WebSecurity::sec_session_start();
 
// Unset all session values 
$_SESSION = array();
 
// get session parameters 
$params = session_get_cookie_params();
 
// Delete the actual cookie. 
setcookie(session_name(),
        '', time() - 42000, 
        $params["path"], 
        $params["domain"], 
        $params["secure"], 
        $params["httponly"]);
 
// Destroy session 
session_destroy();

if (isset($_GET["ReturnUrl"])) {
	header('Location: ' . $_GET["ReturnUrl"]);
} else {
	header('Location: ' . SITE_ROOT . 'secure/login');	
}
