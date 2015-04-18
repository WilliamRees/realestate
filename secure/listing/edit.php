<?php
	include_once '../authorize.php';
	include_once '../../includes/listing.php';
	include_once 'config.php';

	if (isset($_GET["Id"])) {
		$listing = Listing::getListingById($_GET["Id"]);
		$featuredImage;
		if (isset($listing))
		{
			
		} else {
			header("Location: " . SITE_ROOT . '/error.php');
			exit;	
		}
	} else {
		header("Location: " . SITE_ROOT . '/error.php');
		exit;	
	}

	
?>

<?php  
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	require_once '../secureheader.php';
?>	

<div id="EditListing" class="container">
<div id="Notification">
		<div>
			<div class="alert" role="alert">
			  
			</div>
		</div>
	</div>
	<div class="row">
		<form id="EditListingForm" method="POST">
			<div class="col-md-6">
				<div class="form-group">
					<label for="Address">Address</label>
					<input type="text" id="Address" name="Address" placeholder="*Address" required class="form-control" 
					value="<?php echo($listing->Address); ?>"/>
				</div>
				<div class="form-group">
					<label for="City">City</label>
					<input type="text" id="City" name="City" placeholder="*City" required class="form-control" 
					value="<?php echo($listing->City); ?>"/>
				</div>
				<div class="form-group">
					<label for="Province">Province</label>
					<input type="text" id="Province" name="Province" placeholder="*Province" required class="form-control" 
					value="<?php echo($listing->Province); ?>"/>
				</div>
				<div class="form-group">
					<label for="Description">Description</label>
					<textarea type="text" id="Description" name="Description" placeholder="*Description" required class="form-control"><?php echo($listing->Description); ?></textarea>
				</div>
				<div class="form-group">
					<label for="Price">Price</label>
					<input type="number" id="Price" name="Price" placeholder="*Price" required class="form-control" 
					value="<?php echo($listing->Price); ?>"/>
				</div>
				<div class="form-group">
					<label for="PropertyType">Property Type</label>
					<input type="text" id="PropertyType" name="PropertyType" placeholder="Property Type" class="form-control" 
					value="<?php echo($listing->PropertyType); ?>"/>
				</div>
			</div>
			<div class="col-md-6">
				
				<div class="form-group">
					<label for="Bedrooms">Bedrooms</label>
					<input id="Bedrooms" name="Bedrooms" placeholder="Bedrooms" class="form-control" 
					value="<?php echo($listing->Bedrooms); ?>"/>
				</div>
				<div class="form-group">
					<label for="Bathrooms">Bathrooms</label>
					<input type="number" id="Bathrooms" name="Bathrooms" placeholder="Bathrooms" class="form-control" 
					value="<?php echo($listing->Bathrooms); ?>"/>
				</div>
				<div class="form-group">
					<label for="LivingSpace">Living Space</label>
					<input type="number" id="LivingSpace" name="LivingSpace" placeholder="Living Space" class="form-control" 
					value="<?php echo($listing->LivingSpace); ?>"/>
				</div>
				<div class="form-group">
					<label for="LandSize">Land Size</label>
					<input type="number" id="LandSize" name="LandSize" placeholder="Land Size" class="form-control" 
					value="<?php echo($listing->LandSize); ?>"/>
				</div>
				<div class="form-group">
					<label for="TaxYear">Tax Year</label>
					<input type="number" id="TaxYear" name="TaxYear" placeholder="Tax Year" class="form-control" 
					value="<?php echo($listing->TaxYear); ?>"/>
				</div>
				<div class="form-group">
					<label for="Taxes">Taxes</label>
					<input type="number" id="Taxes" name="Taxes" placeholder="Taxes" class="form-control" 
					value="<?php echo($listing->Taxes); ?>"/>
				</div>
				<div class="form-group">
					<label for="BuildingAge">Building Age</label>
					<input type="number" id="BuildingAge" name="BuildingAge" placeholder="Building Age" class="form-control" 
					value="<?php echo($listing->BuildingAge); ?>"/>
				</div>
				<div class="form-group">
					<label for="BuildingAge">Latitude</label>
					<input type="number" id="Latitude" name="Latitude" placeholder="Latitude" class="form-control" 
					value="<?php echo($listing->Latitude); ?>"/>
				</div>
				<div class="form-group">
					<label for="BuildingAge">Lonitude</label>
					<input type="number" id="Lonitude" name="Lonitude" placeholder="Lonitude" class="form-control" 
					value="<?php echo($listing->Longitude); ?>"/>
				</div>
				<div class="form-inline">
					<div class="checkbox">
						<label for="Sold">Sold
							<input type="checkbox" id="Sold" name="Sold" <?php echo(($listing->Sold) ? "checked='checked'" : "")  ?> />
						</label>
					</div>

					<div class="checkbox">
						<label for="Published">Published
							<input type="checkbox" id="Published" name="Published" <?php echo(($listing->Published) ? "checked='checked'" : "")  ?> />
						</label>
					</div>
					<div class="checkbox">
						<label for="Featured">Featured
							<input type="checkbox" id="Featured" name="Featured" <?php echo(($listing->Featured) ? "checked='checked'" : "")  ?> />
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div id="NewListingDropZone" class="dropzone">
					<div id="template">
			        	<div class="col-md-3">
						    <div>
						        <img data-dz-thumbnail />
							    
							    <div>
							        <p class="name" data-dz-name></p>
							        <strong class="error text-danger" data-dz-errormessage></strong>
							        <p class="size" data-dz-size></p>
							    </div>
							    <div>
					    			<button data-dz-remove class="btn btn-warning cancel">
							          <i class="glyphicon glyphicon-ban-circle"></i>
							      </button>
							    </div>
						    </div>
						  </div>
			        </div>
			        <div class="col-md-3 dz-image-preview listing-image" id="ListingImageTemplate">
						<div>
							<div>
								<img src="" />
							</div>
						    <div>
						        <p class="name" data-dz-name><?php echo($img); ?></p>
						    </div>
						    <div>
				    			<button data-listing-image-remove-target="<?php echo("#Img" . $i) ?>" data-listing-id="<?php echo($listing->Id); ?>" data-listing-image-remove="<?php echo($img); ?>" class="btn btn-warning remove">
					          		<i class="glyphicon glyphicon-trash"></i>
						      	</button>
						    </div>
					    </div>
				  	</div>
						<div class="files row" id="Dropzone-Preview">
						<?php if(isset($listing->FeaturedImage)) : ?>
							<div class="col-md-3 dz-image-preview listing-image" id="<?php echo("FeaturedImg") ?>">
								<div>
									<div>
										<img src="<?php echo(SITE_ROOT . "uploads/" . $listing->FeaturedImage); ?>" />
									</div>
								    <div>
								    	<label class="radio-button">
								    		Featured
								    		<input type="radio" name="FeaturedImage" data-image-name="<?php echo($listing->FeaturedImage); ?>" checked="checked"/>
								    	</label>
								        <p class="name" data-dz-name><?php echo($listing->FeaturedImage); ?></p>
								    </div>
								    <div>

						    			<button data-listing-image-remove-target="<?php echo("#FeaturedImg") ?>" data-listing-id="<?php echo($listing->Id); ?>" data-listing-image-remove="<?php echo($listing->FeaturedImage); ?>" class="btn btn-warning remove">
							          		<i class="glyphicon glyphicon-trash"></i>
								      	</button>
								    </div>
							    </div>
						  	</div>
						<?php endif; ?>
						<?php
								for ($i = 0; $i < sizeOf($listing->Images); $i++) {
									$img = $listing->Images[$i];
							?>
							<div class="col-md-3 dz-image-preview listing-image" id="<?php echo("Img" . $i) ?>">
								<div>
									<div>
										<img src="<?php echo(SITE_ROOT . "uploads/" .$img); ?>" />
									</div>
								    <div>
								    	<label class="radio-button">
								    		Featured
								    		<input type="radio" name="FeaturedImage" data-image-name="<?php echo($img); ?>" />
								    	</label>
								        <p class="name" data-dz-name><?php echo($img); ?></p>
								    </div>
								    <div>

						    			<button data-listing-image-remove-target="<?php echo("#Img" . $i) ?>" data-listing-id="<?php echo($listing->Id); ?>" data-listing-image-remove="<?php echo($img); ?>" class="btn btn-warning remove">
							          		<i class="glyphicon glyphicon-trash"></i>
								      	</button>
								    </div>
							    </div>
						  	</div>

							<?php
								}
							?>
							
					        <p id="Dropzone-DefaultText" class="col-md-3" dz-clickable>
					        	<span class="dz-upload-btn">
									Drop files images or click to upload.<br/>
									<span class="glyphicon glyphicon-plus"></span>
								</span>
							</p>
				        </div>
						
					</div>
				</div>	
				<div class="form-group">
					<div id="Dropzone-Actions">
						<button type="reset" class="btn btn-warning cancel">
							<i class="glyphicon glyphicon-ban-circle"></i>
							<span>Remove all</span>
						</button>
					</div>		
					<input id="ListingId" type="hidden" 
					value="<?php echo($listing->Id); ?>" />				      		      
					<button id="Submit" type="submit" class="btn btn-primary start ladda-button" data-style="expand-right">
						<span class="ladda-label">
							<i class="glyphicon glyphicon-upload"></i>
							<span>Submit</span>
						</span>
					</button>
					
				</div>
			</div>
		</form>
	</div>
</div>



<?php include_once '../footerscripts.php' ?>
<script>
	re.views.secure.listing.editlisting.init();
</script>
<?php include_once '../footer.php' ?>
<?php  
}
?>