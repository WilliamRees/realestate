<?php
	include_once '../Authorize.php';
	include_once '../../includes/listing.php';
	include_once '../ApiResult.php';

	if ($_SERVER['REQUEST_METHOD'] === 'GET') {
		$result = false;

		if (isset($_GET['SearchText'], $_GET['ShowAddressOnly']) && $_GET['ShowAddressOnly'] == "true") {
			$listings = Listing::searchListings($_GET['SearchText']);
			$addresses = array();
			if ($listings != null) {
				for ($i = 0; $i < sizeOf($listings); $i++) {
					$listing = $listings[$i];
					array_push($addresses, $listing->Address);
				}
			}
			$result = true;
			$listings = $addresses;
		}
		else if (isset($_GET['SearchText'])) {
			$listings = Listing::searchListings($_GET['SearchText']);
			if ($listings != null) {
				$result = true;
			}
		}

		if ($result) {
			$result = new ApiResult(true, '');
			$result->Data = $listings;

			header('Content-Type: application/json');
			echo json_encode($result);
		} else {
			header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
			$result = new ApiResult(false, '');
			$result->Errors = array("An unknown error occured.");
			echo json_encode($result);
		}	
	}
?>