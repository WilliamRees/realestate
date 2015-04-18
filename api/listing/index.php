<?php
	include_once '../Authorize.php';
	include_once '../../includes/listing.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['Method'] == "delete") {
		$id = $_POST["Id"];
		if (isset($id) && Listing::delete($id))
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

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$result = false;
		$listing = null;
		if (isset($_POST['Address'], $_POST['City'], $_POST['Province'], $_POST['Description'], $_POST['Price'])) {
			$listing = new Listing($_POST['Address'], $_POST['City'], $_POST['Province'], "Canada", $_POST['Description'], $_POST['Price'], $_POST['Bedrooms'], $_POST['Bathrooms'], $_POST['LivingSpace']);
			$listing->PropertyType = $_POST['PropertyType'];
			$listing->LandSize = $_POST['LandSize'];
			$listing->TaxYear = $_POST['TaxYear'];
			$listing->Taxes = $_POST['Taxes'];
			$listing->BuildingAge = $_POST['BuildingAge'];
			$listing->Published = ($_POST['Published'] == "true") ? 1 : 0;
			$listing->Sold = ($_POST['Sold'] == "true") ? 1 : 0;
			$listing->Latitude = $_POST['Latitude'];
			$listing->Longitude = $_POST['Longitude'];
			$listing->Featured = ($_POST['Featured'] == "true") ? 1 : 0;
			$listing->ShortDescription = $_POST['ShortDescription'];
			$listing->VirtualTour = $_POST['VirtualTour'];
			if (isset($_POST['Id'])) {
				$listing->Id = $_POST['Id'];
			}
		}

		if (isset($_POST['Method']) && $_POST['Method'] == 'put') {
			if ($_POST['Featured'] == 'true' && (!isset($_POST['FeaturedImage']) || !isset($_POST['ShortDescription']) || strlen($_POST['ShortDescription']) == 0)) {
				header('Content-Type: application/json');
				$result = new ApiResult(false, '');
				$result->Errors = array("You must select a featured image and provide a short description");
				echo json_encode($result);
				exit;
			}

			if ($listing->update()) {
				$result = true;
			}

			if ($result && $listing->Featured == 1 && isset($_POST['FeaturedImage'])) {
				$listing->setFeaturedImage($_POST['FeaturedImage']);
			}

		} else {
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