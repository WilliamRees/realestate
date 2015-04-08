<?php 
	
	class ImageHandler
	{
		public static function filename($postname) {
			return $_FILES[$postname]["name"];
		}
		public static function upload($uploaddir, $postname) { 
			try {
				$target_dir = $uploaddir;
				$target_file = $target_dir . basename($_FILES[$postname]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				$result = null;
				// Check if image file is a actual image or fake image
				if(isset($_POST["submit"])) {
				    $check = getimagesize($_FILES[$postname]["tmp_name"]);
				    if($check === false) {
				        return "File is not an image.";
				    }
				}
				// Check if file already exists
				if (file_exists($target_file)) {
				    return "Sorry, file already exists.";
				}
				// Check file size
				//if ($_FILES[$postname]["size"] > 500000) {
				    //return "Sorry, your file is too large.";
				//}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
				    return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				}
				
			    if (move_uploaded_file($_FILES[$postname]["tmp_name"], $target_file)) {
			        return true;
			    } else {
			        return "Sorry, there was an error uploading your file.";
			    }
				
			} catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}

		public static function delete($uploaddir, $filename) {
			$ds          = DIRECTORY_SEPARATOR;  //1
 
			$storeFolder = $uploaddir;   //2
			      
			$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
			$targetFile =  $targetPath. $filename;
			   
			if (!unlink($targetFile))
			{
				return "Error deleting $file";
			}
			else
			{
				return true;
			}
		}	
	}
	
?>