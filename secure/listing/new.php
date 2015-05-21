<?php
include_once '../authorize.php';
include_once '../../includes/imagehandler.php';
include_once '../../includes/listing.php';

?>



 
<?php  
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	require_once '../secureheader.php';
?>	

<div class="container">
	<div id="Notification">
		<div>
			<div class="alert" role="alert">
			  
			</div>
		</div>
	</div>
	<div class="row">
		<form id="NewListing" method="POST">
			<div class="col-md-6">
				<div class="col-md-12">
					<div class="form-group">
						<label for="Address">Address</label>
						<input type="text" id="Address" name="Address" required class="form-control" />
					</div>
					<div class="form-group">
						<label for="City">City</label>
						<input type="text" id="City" name="City" required class="form-control" />
					</div>
					<div class="form-group">
						<label for="Province">Province</label>
						<input type="text" id="Province" name="Province" required class="form-control" />
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="Description">Description</label>
						<textarea type="text" id="Description" name="Description" required class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="ShortDescription">Short Description</label>
						<textarea id="ShortDescription" name="ShortDescription" class="form-control"></textarea>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label for="Price">Price</label>
						<input type="text" id="Price" name="Price" required class="form-control" />
					</div>
					<div class="form-group">
						<label for="PropertyType">Property Type</label>
						<input type="text" id="PropertyType" name="PropertyType" class="form-control" />
					</div>
					<div class="form-group">
						<label for="Bedrooms">Bedrooms</label>
						<input id="Bedrooms" name="Bedrooms" class="form-control" />
					</div>
				</div>
			</div>
			
			
			
			<div class="col-md-6">
				<div class="form-group">
					<label for="Bathrooms">Bathrooms</label>
					<input type="number" id="Bathrooms" name="Bathrooms" class="form-control" />
				</div>
				<div class="form-group">
					<label for="LivingSpace">Living Space</label>
					<input type="text" id="LivingSpace" name="LivingSpace" class="form-control" />
				</div>
				<div class="form-group">
					<label for="LandSize">Lot Size</label>
					<input type="text" id="LandSize" name="LandSize" class="form-control" />
				</div>
				<div class="form-group">
					<label for="TaxYear">Tax Year</label>
					<input type="number" id="TaxYear" name="TaxYear" class="form-control" />
				</div>
				<div class="form-group">
					<label for="Taxes">Taxes</label>
					<input type="number" id="Taxes" name="Taxes" class="form-control" />
				</div>
				<div class="form-group">
					<label for="BuildingAge">Building Age</label>
					<input type="text" id="BuildingAge" name="BuildingAge" class="form-control" />
				</div>
				<div class="form-group">
					<label for="BuildingAge">Latitude</label>
					<input type="number" id="Latitude" name="Latitude" class="form-control" />
				</div>
				<div class="form-group">
					<label for="BuildingAge">Longitude</label>
					<input type="number" id="Lonitude" name="Lonitude" class="form-control" />
				</div>
				
				<div class="form-group">
					<label for="VirtualTour">Virtual Tour</label>
					<input type="text" id="VirtualTour" name="VirtualTour" class="form-control" />
				</div>
				<div class="form-inline">				
					<div class="checkbox">
						<label for="Sold">Sold
							<input type="checkbox" id="Sold" name="Sold" />
						</label>
					</div>

					<div class="checkbox">
						<label for="Published">Published
							<input type="checkbox" id="Published" name="Published" />
						</label>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<div id="NewListingDropZone" class="dropzone" dz-clickable>
						<div class="files row" id="Dropzone-Preview">
							<div id="template">
								<div class="col-md-3">
								    <div>
								        <img data-dz-thumbnail />
									    
									    <div>
									        <p class="name" data-dz-name></p>
									        <strong class="error text-danger" data-dz-errormessage></strong>
									        <p class="size" data-dz-size></p>
									        <!--<div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
									          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
									        </div>-->
									    </div>
									    <div>
							    			<button data-dz-remove class="btn btn-warning cancel">
									          <i class="glyphicon glyphicon-ban-circle"></i>
									      </button>
									    </div>
								    </div>
							  	</div>
							</div>
				        	
				        </div>
						<p id="Dropzone-DefaultText" dz-clickable>
							Drop files images or click to upload.<br/>
							<span class="glyphicon glyphicon-plus"></span>
						</p>
					</div>
				</div>	
				<div class="form-group">
					<div id="Dropzone-Actions">
						<button type="reset" class="btn btn-warning cancel">
							<i class="glyphicon glyphicon-ban-circle"></i>
							<span>Remove all</span>
						</button>
					</div>
					<input id="ListingId" type="hidden" value="" />				      
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
	re.views.secure.listing.newlisting.init();
</script>
<?php include_once '../footer.php' ?>
<?php  
}
?>