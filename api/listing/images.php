<?php
	include_once '../../includes/authorize.php';
	include_once '../../includes/listing.php';
	include_once '../../includes/imagehandler.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$result = false;
		
		if (isset($_FILES["file"], $_POST["ListingId"])){
			$result = ImageHandler::upload("../../uploads/", "file");
			if (gettype($result) != 'string') {
				ImageHandler::filename("file");
				Listing::addImagesById($_POST["ListingId"], ImageHandler::filename("file"));
				header('Content-Type: application/json');
				echo json_encode(true);
				exit;
			} else {
				echo($result);
				header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
				exit;
			}
		}			
	} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		parse_str(file_get_contents("php://input"), $delete_vars);
		$fileName = $delete_vars["FileName"];
		$id = $delete_vars["Id"];

		if (Listing::deleteImageForListing($id, $fileName)) {
			$result = new ApiResult(true, '');
			header('Content-Type: application/json');
			echo json_encode($result);
			exit;
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			$result = new ApiResult(false, '');
			$result->Errors = array("There was a problem deleting the image with file name " . $fileName);
			echo json_encode($result);
			exit;
		}
	}
?>