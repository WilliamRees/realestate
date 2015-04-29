<?php
	include_once '../Authorize.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['Method'] == "delete") {
		$id = $_POST["Id"];
		
		if (isset($id) && WebSecurity::deleteUser($id))
		{
			$result = new ApiResult(true, '');
			$result->Data = array(
				"Id" => $id
			);
			header('Content-Type: application/json');
			echo json_encode($result);
			exit;
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			$result = new ApiResult(false, '');
			$result->Errors = array("There was a problem deleting this listing. Please refresh and try again.");
			echo json_encode($result);
			exit;
		}
	}
?>