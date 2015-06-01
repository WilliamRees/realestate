<?php
include_once '../../includes/authorize.php';
include_once '../../includes/listing.php';
include_once '../../includes/imagehandler.php';
include_once '../ApiResult.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$result = false;

	if (isset($_POST["ImageOrder"], $_POST["ListingId"])) {
		$order = $_POST["ImageOrder"];
		$listingId = $_POST["ListingId"];

		foreach ($order as $img) {
			$filename = $img["filename"];
			$order = $img["order"];

			Listing::setImageOrder($listingId, $filename, $order);
		}
	}
}

?>