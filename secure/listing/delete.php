<?php
if (isset($_POST["FileName"])) {
	$ds          = DIRECTORY_SEPARATOR;  //1
 
	$storeFolder = 'uploads';   //2
	      
	$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
	     
	$targetFile =  $targetPath. $_POST["FileName"];
	   
	if (!unlink($targetFile))
	{
		echo ("Error deleting $file");
	}
	else
	{
		echo ("Deleted $file");
	}
}
?>