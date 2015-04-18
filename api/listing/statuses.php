<?php
	include_once '../Authorize.php';
	include_once '../../includes/listing.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$result = false;

		if (isset($_GET["status"], $_GET["value"], $_GET["id"]))
		{
			if ($_GET["status"] == "published") {
				$result = Listing::setPublishedStatus($_GET["id"], $_GET["value"]);
			}

			if ($_GET["status"] == "sold") {
				$result = Listing::setSoldStatus($_GET["id"], $_GET["value"]);
			}

			if ($_GET['status'] == "priority") {
				$result = Listing::setPriorityStatus($_GET["id"], $_GET["value"]);
			}

			if ($result) {
				$result = new ApiResult(true, '');
				//$result->Data = [
				//    "Id" => $_GET["id"]
				//];	
				$result->Data = array(
					"Id" => $_GET["id"]
				);
				header('Content-Type: application/json');
				echo json_encode($result);
				exit;
			}

			
			
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			$result = new ApiResult(false, '');
			$result->Errors = array("There was a problem deleting this listing. Please refresh and try again.");
			echo json_encode($result);

		}
	} 
?>