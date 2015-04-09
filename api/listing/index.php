<?php
	include_once '../Authorize.php';
	include_once '../../includes/listing.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$result = false;
		if (isset($_POST['Address'], $_POST['City'], $_POST['Province'], $_POST['Description'], $_POST['Price'])) {
			$listing = new Listing($_POST['Address'], $_POST['City'], $_POST['Province'], "Canada", $_POST['Description'], $_POST['Price'], $_POST['Bedrooms'], $_POST['Bathrooms'], $_POST['LivingSpace']);
			$listing->PropertyType = $_POST['PropertyType'];
			$listing->LandSize = $_POST['LandSize'];
			$listing->TaxYear = $_POST['TaxYear'];
			$listing->Taxes = $_POST['Taxes'];
			$listing->BuildingAge = $_POST['BuildingAge'];
			$listing->Published = ($_POST['Published'] == "true") ? 1 : 0;
			$listing->Sold = ($_POST['Sold'] == "true") ? 1 : 0;
			$listing->New = ($_POST['New'] == "true") ? 1 : 0;
			$listing->Latitude = $_POST['Latitude'];
			$listing->Longitude = $_POST['Longitude'];

			if ($listing->save()) {
				$result = true;
			}
		}

		if ($result) {
			header('Content-Type: application/json');
			$result = new ApiResult(true, '');
			$result->Data = $listing;
			echo json_encode($result);
		} else {
			$result = new ApiResult(false, '');
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			echo json_encode($result);
		}	
	}

	if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
		parse_str(file_get_contents("php://input"),$put);
		$result = false;
		if (isset($put['Address'], $put['City'], $put['Province'], $put['Description'], $put['Price'])) {
			$listing = new Listing($put['Address'], $put['City'], $put['Province'], "Canada", $put['Description'], $put['Price'], $put['Bedrooms'], $put['Bathrooms'], $put['LivingSpace']);
			$listing->PropertyType = $put['PropertyType'];
			$listing->LandSize = $put['LandSize'];
			$listing->TaxYear = $put['TaxYear'];
			$listing->Taxes = $put['Taxes'];
			$listing->BuildingAge = $put['BuildingAge'];
			$listing->Id = $put['Id'];
			$listing->Published = ($put['Published'] == "true") ? 1 : 0;
			$listing->Sold = ($put['Sold'] == "true") ? 1 : 0;
			$listing->New = ($put['New'] == "true") ? 1 : 0;
			$listing->Latitude = $put['Latitude'];
			$listing->Longitude = $put['Longitude'];
			
			if ($listing->update()) {
				$result = true;
			}
		}

		if ($result) {
			header('Content-Type: application/json');
			$result = new ApiResult(true, '');
			$result->Data = $listing;
			echo json_encode($result);
		} else {
			$result = new ApiResult(false, '');
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			echo json_encode($result);
		}	
	}

	if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
		parse_str(file_get_contents("php://input"),$post_vars);
		$id = $post_vars["Id"];
		if (isset($id) && Listing::delete($id))
		{
			$result = new ApiResult(true, '');
			$result->Data = array(
				"Id" => $id
			);
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			$result = new ApiResult(false, '');
			$result->Errors = array("There was a problem deleting this listing. Please refresh and try again.");
			echo json_encode($result);

		}
	}

	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		if (isset($_GET['Id'])) {
			$listing = Listing::getListingById($_GET['Id']);
			$result = new ApiResult(true, '');
			$result->Data = $listing;
			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			$listings;
			if (isset($_GET['page'], $_GET['pagesize'])) {
				$listings = Listing::getListings($_GET['page'], $_GET['pagesize']);	
			} else {
				$listings = Listing::getListings();	
			}
			
			$result = new ApiResult(true, '');
			$result->Data = $listings;
			header('Content-Type: application/json');
			echo json_encode($result);
		}
	}
?>