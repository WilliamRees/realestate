<?php
include_once 'imagehandler.php';
class Listing {
	public $Id;
	public $Address;
	public $City;
	public $Province;
	public $Country;
	public $Description;
	public $Price;
	public $Images;
	public $PropertyType;
	public $Bedrooms;
	public $Bathrooms;
	public $LivingSpace;
	public $LandSize;
	public $TaxYear;
	public $Taxes;
	public $BuildingAge;
	public $Sold;
	public $Published;
	public $Latitude;
	public $Longitude;
	public $Featured;
	public $FeaturedImage;
	public $PublishedDate;
	public $Priority;
	public $ShortDescription;
	public $VirtualTour;

	function __construct($address, $city, $province, $country, $description, $price, $bedrooms, $bathrooms, $livingSpace) 
	{
		$this->Address = $address;
		$this->City = $city;
		$this->Province = $province;
		$this->Country = $country;
		$this->Description = $description;
		$this->Price = $price;
		$this->Images = array();
		$this->Bedrooms = $bedrooms;
		$this->Bathrooms = (int)$bathrooms;
		$this->LivingSpace = (int)$livingSpace;

		$this->PropertyType = null;
		$this->LandSize = null;
		$this->TaxYear = null;
		$this->Taxes = null;
		$this->BuildingAge = null;
		$this->Sold = false;
		$this->Published = false;
		$this->Latitude = null;
		$this->Longitude = null;
		$this->CreatedDate = null;
		$this->Featured = 0;
		$this->FeaturedImage = null;
		$this->PublishedDate = null;
		$this->Priority = 0;
		$this->ShortDescription = null;
		$this->VirtualTour = null;

		$this->isValid();
	}

	public function save() {
		$conn = self::conn();
		$result = null;
		if($stmt = $conn->prepare("INSERT INTO Listings (Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Featured, ShortDescription, VirtualTour) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)")) {
			//$this->bindParams($stmt);
			$stmt->bind_param("sssssdssiiiidiiiiiiss", 
			$this->Address, 
			$this->City, 
			$this->Province, 
			$this->Country, 
			$this->Description, 
			$this->Price,
			$this->PropertyType,
			$this->Bedrooms,
			$this->Bathrooms,
			$this->LivingSpace,
			$this->LandSize,
			$this->TaxYear,
			$this->Taxes,
			$this->BuildingAge,
			$this->Sold,
			$this->Published,
			$this->Latitude,
			$this->Longitude,
			$this->Featured,
			$this->ShortDescription,
			$this->VirtualTour);

	        if($stmt->execute())
	        {
	        	$this->Id = mysqli_stmt_insert_id($stmt);
				$stmt->close();	
				$result = true;
	        } else {
	        	$result = false;
	        }
	        
		}

		$conn->close();
		return $result;
	}

	public function update() {
		$conn = self::conn();
		$result;
		if($stmt = $conn->prepare("UPDATE Listings SET Address = ?, City = ?, Province = ?, Country = ?, Description = ?, Price = ?, PropertyType = ?, Bedrooms = ?, Bathrooms = ?, LivingSpace = ?, LandSize = ?, TaxYear = ?, Taxes = ?, BuildingAge = ?, Sold = ?, Published = ?, Latitude = ?, Longitude = ?, Featured = ?, ShortDescription = ?, VirtualTour = ? WHERE Id = " . $this->Id)) {
			$this->bindParams($stmt);

	        if($stmt->execute())
	        {
				$stmt->close();	
				$result = true;
	        } else {
	        	$result = false;
	        }
	        
		}

		$conn->close();
		return $result;
	}

	public static function delete($id) {
		$conn = self::conn();
		$result = false;
		$listing = Listing::getListingById($id);
		for ($i = 0; $i < sizeOf($listing->Images); $i++) {
			$img = $listing->Images[$i];
			ImageHandler::delete("../uploads", $img);
		}
		if($stmt = $conn->prepare("DELETE FROM Listings WHERE id=?")) {
			$stmt->bind_param("i", $id);
	        if ($stmt->execute()){
	        	$stmt->close();
	        	$result = true;
	        }
			
		}

		$conn->close();
		return $result;
	}

	public static function setPublishedStatus($id, $status) {
		$sqlCommand = "UPDATE Listings SET Published = ?, PublishedDate = \"".date("Y-m-d")."\" WHERE Id = ?";
		return self::setStatus($sqlCommand, $id, $status);
	}

	public static function setSoldStatus($id, $status) {
		$sqlCommand = "UPDATE Listings SET Sold = ? WHERE Id = ?";
		return self::setStatus($sqlCommand, $id, $status);
	}

	public static function setFeaturedStatus($id, $status) {
		$sqlCommand = "UPDATE Listings SET Featured = ? WHERE Id = ?";
		return self::setStatus($sqlCommand, $id, $status);
	}

	public static function setPriorityStatus($id, $status) {
		$sqlCommand = "UPDATE Listings SET Priority = ? WHERE Id = ?";
		return self::setStatus($sqlCommand, $id, $status);
	}

	public static function setStatus($sqlCommand, $id, $status) {
		$conn = self::conn();
		$result = false;
		if ($stmt = $conn->prepare($sqlCommand)) {
			$stmt->bind_param("ii", $status, $id);
			if ($stmt->execute()) {
				$stmt->close();
				$result = true;
			}
		}

		$conn->close();
		return $result;
	}

	public static function getListings($page, $pageSize, $published) {
		mysqli_report();
		$conn = self::conn();
		$stmt = null;
		$listings = array();

		if (isset($page, $pageSize)) {
			$sqlCommand = ($published) ? "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Published = 1 ORDER BY Priority ASC, PublishedDate DESC LIMIT ?, ?" :
			 "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings LIMIT ?, ? ORDER BY Created DESC";
			if ($stmt = $conn->prepare($sqlCommand)) {
				$stmt->bind_param("ii", $page, $pageSize);
			}
		} else {
			$sqlCommand = "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Id > ? ORDER BY Created DESC";
			if (isset($published)) {
				$sqlCommand = "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Id > ? AND Published = " . $published . " ORDER BY Priority ASC, PublishedDate DESC";
			}
			$stmt = $conn->prepare($sqlCommand);
			$startId = 0;
			$stmt->bind_param("i", $startId);
		}

		if ($stmt) {
			$listings = Listing::queryListings($stmt);
		}

		$conn->close();
		return $listings;
	}

	public static function getFeaturedListings () {
		$conn = self::conn();
		$featuredlistings = array();
		$sqlCommand = "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Featured = 1 AND Published = 1 ORDER BY Priority ASC, PublishedDate DESC";
		$listings = $conn->query($sqlCommand);
		
    	if ($listings->num_rows > 0) {
    		while($listing = $listings->fetch_assoc()) {
    			$tempListing = new Listing($listing["Address"], $listing["City"], $listing["Province"], $listing["Country"], $listing["Description"], $listing["Price"], $listing["Bedrooms"], $listing["Bathrooms"], $listing["LivingSpace"]);
    			$tempListing->Id = $listing["Id"];
				$tempListing->PropertyType = $listing["PropertyType"];
				$tempListing->LandSize = $listing["LandSize"];
				$tempListing->TaxYear = $listing["TaxYear"];
				$tempListing->Taxes = $listing["Taxes"];
				$tempListing->BuildingAge = $listing["BuildingAge"];
				$tempListing->Sold = $listing["Sold"];
				$tempListing->Published = $listing["Published"];
				$tempListing->Latitude = $listing["Latitude"];
				$tempListing->Longitude = $listing["Longitude"];
				$tempListing->CreatedDate = $listing["Created"];
				$tempListing->Featured = $listing["Featured"];
				$tempListing->FeaturedImage = $listing["FeaturedImage"];
				$tempListing->Priority = $listing["Priority"];
				$tempListing->PublishedDate = $listing["PublishedDate"];
				$tempListing->ShortDescription = $listing["ShortDescription"];
				$tempListing->VirtualTour = $listing["VirtualTour"];
				$tempListing->getFeaturedImage();
    			array_push($featuredlistings, $tempListing);
    		}
		}

		$conn->close();
		return $featuredlistings;
	}

	public static function getListingById($id) {
		$conn = self::conn();
		$listing = null;
		if($stmt = $conn->prepare("SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Id = ?")) {
			
		    $stmt->bind_param("i", $id);
	        $listings = Listing::queryListings($stmt);
	        $listing = $listings[0];
	   	}

	   	$conn->close();
	   	return $listing;
	}

	public static function searchListings($searchText) {
		$conn = self::conn();
		$sqlCommand = "SELECT Id, Address, City, Province, Country, Description, Price, PropertyType, Bedrooms, Bathrooms, LivingSpace, LandSize, TaxYear, Taxes, BuildingAge, Sold, Published, Latitude, Longitude, Created, Featured, Priority, PublishedDate, ShortDescription, VirtualTour FROM Listings WHERE Address LIKE ?";
		$listings = array();
		$searchText = '%' . $searchText . '%';
		if ($stmt = $conn->prepare($sqlCommand)) {
			$stmt->bind_param("s", $searchText);
			$listings = Listing::queryListings($stmt);
		}

		$conn->close();
		return $listings;
	}

	private static function queryListings(&$stmt) {
		$listings = array();
		$stmt->execute();
		$stmt->bind_result($Id, $Address, $City, $Province, $Country, $Description, $Price, $PropertyType, $Bedrooms, $Bathrooms, $LivingSpace, $LandSize, $TaxYear, $Taxes, $BuildingAge, $Sold, $Published, $Latitude, $Longitude, $Created, $Featured, $Priority, $PublishedDate, $ShortDescription, $VirtualTour);
		while ($row = $stmt->fetch()) {
			$listing = new Listing($Address, $City, $Province, $Country, $Description, $Price);
	    	$listing->Id = $Id;
			$listing->PropertyType = $PropertyType;
			$listing->Bedrooms = $Bedrooms;
			$listing->Bathrooms = $Bathrooms;
			$listing->LivingSpace = $LivingSpace;
			$listing->LandSize = $LandSize;
			$listing->TaxYear = $TaxYear;
			$listing->Taxes = $Taxes;
			$listing->BuildingAge = $BuildingAge;
			$listing->Sold = $Sold;
			$listing->Published = $Published;
			$listing->Latitude = $Latitude;
			$listing->Longitude = $Longitude;
			$listing->CreatedDate = $Created;
			$listing->Featured = $Featured;
			$listing->Priority = $Priority;
			$listing->PublishedDate = $PublishedDate;
			$listing->ShortDescription = $ShortDescription;
			$listing->VirtualTour = $VirtualTour;

			$conn = self::conn();
			$images = $conn->query("SELECT Name FROM ListingImages WHERE ListingId = " . $listing->Id . " AND Featured = 0");
			$listingImages = array();
	    	if ($images->num_rows > 0) {
	    		while($img = $images->fetch_assoc()) {
	    			array_push($listingImages, $img["Name"]);
	    		}
			}

			$listing->getFeaturedImage();

			$listing->Images = $listingImages;
			array_push($listings, $listing);
			$conn->close();
		}

		$stmt->close();
		return $listings;
	}

	public function getFeaturedImage () {
		$conn = self::conn();
		$result;

		if ($stmt = $conn->prepare("SELECT Name FROM ListingImages WHERE Featured = 1 AND ListingId = ?")) {
			$stmt->bind_param("i", $this->Id);
			$result = $stmt->execute();
			$stmt->bind_result($FeaturedImage);
			while ($row = $stmt->fetch()) {
				$this->FeaturedImage = $FeaturedImage;
			}
			$stmt->close();
		}

		$conn->close();
		return $result;
	}

	public function setFeaturedImage ($name) {
		$conn = self::conn();
		$result;

		if ($stmt = $conn->prepare("UPDATE ListingImages SET Featured = 0 WHERE ListingId = ?")) {
			$stmt->bind_param("i", $this->Id);
			$result = $stmt->execute();
			$stmt->close();
		}

		if ($result && $stmt = $conn->prepare("UPDATE ListingImages SET Featured = 1 WHERE Name = ? AND ListingId = ?")) {
			$stmt->bind_param("si", $name, $this->Id);
			$result = $stmt->execute();
			$stmt->close();
		}

		$conn->close();
		return $result;
	}

	public static function addImagesById($id, $filename) {
		$conn = self::conn();
		$result;
		$filename = $id."-".$filename;
		if ($stmt = $conn->prepare("INSERT INTO ListingImages (ListingId, Name) VALUES(?, ?)")) {
			$stmt->bind_param("is", $id, $filename);
			$result = $stmt->execute();
			$stmt->close();
		}

		$conn->close();
		return $result;
	}

	public static function deleteImageForListing($id, $filename) {
		$conn = self::conn();
		$result = ImageHandler::delete("../uploads", $filename);

		if (gettype($result) != 'string') {
			$sqlCommand = "DELETE FROM ListingImages WHERE Name = ? AND ListingId = ?";
			if($stmt = $conn->prepare($sqlCommand)) {
				$stmt->bind_param('si',$filename, $id);
				$result = $stmt->execute();
				$stmt->close();
			}
		} else {
			$result = false;
		}

		$conn->close();
		
		return $result;
	}



	public static function count($published) { 
		$conn = self::conn();

		$query = ($published) ? "SELECT COUNT(*) FROM Listings WHERE Published = 1" : "SELECT COUNT(*) FROM Listings";
 		if ($stmt = $conn->prepare($query)) {
			$result = $stmt->execute();
			$stmt->store_result();
	        if ($stmt->num_rows != 1)
        	{
        		$stmt->close();
        		$conn->close();
        		return 0;
        	}
			
			$stmt -> bind_result($count);
	      	$stmt -> fetch();
			$stmt->close();
	   	}

	   	$conn->close();
	   
	   	return $count;
	}

	private function bindParams(&$stmt) {
		$stmt->bind_param("sssssdssiiiidiiiiiiss", 
			$this->Address, 
			$this->City, 
			$this->Province, 
			$this->Country, 
			$this->Description, 
			$this->Price,
			$this->PropertyType,
			$this->Bedrooms,
			$this->Bathrooms,
			$this->LivingSpace,
			$this->LandSize,
			$this->TaxYear,
			$this->Taxes,
			$this->BuildingAge,
			$this->Sold,
			$this->Published,
			$this->Latitude,
			$this->Longitude,
			$this->Featured,
			$this->ShortDescription,
			$this->VirtualTour);
	}

	private static function conn() {

		$conn = new mysqli(HOST, USER, PASSWORD, DATABASE);

		if (mysqli_connect_errno())
		{
			echo "Failed to connect to MySql: " . mysqli_connect_error();
		}
		
		return $conn;
	}

	private static function isListingValid($listing) {
		//Validation for Bathrooms property
		if (isset($listing->Bathrooms) && !is_int($listing->Bathrooms)) {
			throw new Exception('Bathrooms must be of type int');
		}
		if (isset($listing->Bathrooms) && $listing->Bathrooms < 0) {
			throw new Exception('Bathrooms must be greater than or equal to zero');
		}

		//Validation for LivingSpace property
		if (isset($listing->LivingSpace) && !is_numeric($listing->LivingSpace)) {
			throw new Exception('LivingSpace must be of type float');
		}
		if (isset($listing->LivingSpace) && $is_float->LivingSpace < 0) {
			throw new Exception('LivingSpace must be greater than or equal to zero');
		}

		//Validation for LandSize property
		if (isset($listing->LandSize) && !is_float($listing->LandSize)) {
			throw new Exception('LandSize must be of type float');
		}
		if (isset($listing->LandSize) && $is_float->LandSize < 0) {
			throw new Exception('LandSize must be greater than or equal to zero');
		}
		
		//Validation for TaxYear property
		if (isset($listing->TaxYear) && !is_int($listing->TaxYear)) {
			throw new Exception('TaxYear must be of type int');
		}
		if (isset($listing->TaxYear) && $listing->TaxYear < 0) {
			throw new Exception('TaxYear must be greater than or equal to zero');
		}

		//Validation for Taxes property
		if (isset($listing->Taxes) && !is_float($listing->Taxes)) {
			throw new Exception('Taxes must be of type float');
		}
		if (isset($listing->Taxes) && $is_float->Taxes < 0) {
			throw new Exception('Taxes must be greater than or equal to zero');
		}
		
		//Validation for BuildingAge property
		if (isset($listing->BuildingAge) && !is_int($listing->BuildingAge)) {
			throw new Exception('BuildingAge must be of type int');
		}
		if (isset($listing->BuildingAge) && $listing->BuildingAge < 0) {
			throw new Exception('BuildingAge must be greater than or equal to zero');
		}
		

		//Validation for Sold property
		if (isset($listing->Sold) && !is_bool($listing->Sold)) {
			throw new Exception('Sold must be of type bool');
		}

		//Validation for Published property
		if (isset($listing->Published) && !is_bool($listing->Published)) {
			throw new Exception('Published must be of type bool');
		}

		return true;

	}

	public function isValid() {
		self::isListingValid($this);
	}
}

?>