<?php 
	include_once("../../includes/CMSUtility.php");
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['Name'], $_POST['Data'])) {
		CMSUtility::UpdateArticleByName($_POST["Name"], $_POST["Data"]);
	} else {
		echo($_SERVER['REQUEST_METHOD']);
		echo($_POST["Name"]);
		echo($_POST["Data"]);
		header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
		exit;
	}
?>