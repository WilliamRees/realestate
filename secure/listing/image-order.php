<?php 
	include_once '../authorize.php';
	include_once '../../includes/listing.php';
	include_once 'config.php';

	if (isset($_GET["Id"])) {
		$listing = Listing::getListingById($_GET["Id"]);
		$count = count($listing->Images);
		if (!isset($listing))
		{
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
<div class="container">
	<div id="Notification">
		<div>
			<div class="alert" role="alert">
			  
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div id="Images">
		<?php foreach ($listing->Images as $img): ?>
			<div class="col-sm-3 col-md-3">
				<div class="thumbnail">
					<img data-name="<?php echo $img ?>" data-order="<?php echo $count ?>" src="<?php echo SITE_ROOT . "uploads/" . $img ?>" />
				</div>
			</div>
			<?php $count = $count - 1; ?>
		<?php endforeach; ?>
	</div>
</div>
<div class="container">
	<div style="padding-left:15px; padding-bottom: 30px;">
		<button id="Submit" type="submit" class="btn btn-primary start ladda-button" data-style="expand-right">
			<span class="ladda-label">
				<i class="glyphicon glyphicon-upload"></i>
				<span>Submit</span>
			</span>
		</button>
	</div>
</div>
<?php include_once '../footerscripts.php' ?>
<script>
var listingId = <?php echo $listing->Id ?>;

$(function () {
	$('#Images').sortable({
		beforeStop: function(event, ui) {
			var total = $('#Images img').length;
			$('#Images img').each(function (index) {
				$this = $(this);
				$this.attr('data-order', total - index);				
			});
		}
	});

	$('#Submit').on('click', function () {
		var l = Ladda.create(document.querySelector('#Submit'));
		l.start();		

		var order = [];
		$('#Images img').each(function () {
			order.push({
				filename: $(this).attr('data-name'),
				order: $(this).attr('data-order')
			});
		});

		re.api.listing.image.order(listingId, order)
		.done(function () {

			setTimeout(function() {
				re.notification.show("#Notification", '<strong>Changes successfully saved.</strong>', 'alert-success', true, false);
			}, 750);
		})
		.always(function(){
			setTimeout(function() {
				l.stop();
			}, 500);
		});


	});
});
</script>
<?php include_once '../footer.php' ?>
<?php  
}
?>