<!-- Includes -->
<?php
	include_once 'includes/WebSecurity.php';
	include_once 'includes/config.php';
	include_once 'includes/listing.php';
	require_once("includes/CMSUtility.php");
	WebSecurity::sec_session_start();
?>
<!-- CUSTOM PAGE CODE -->
<?php 
	$page = (isset($_GET['page']) ? $_GET['page'] - 1 : 0);
	$pageSize = 9;
	$listings = Listing::getListings(($page * $pageSize), $pageSize, true);
	$totalListings = Listing::count(true);
?>
<html>
	<head>

	<!-- CHECK IF USER IS AUTHENTICATED -->
	<?php if (WebSecurity::isAuthenticated($mysqli)): ?>
		
	<?php endif; ?>

	</head>
	<body>

	<!-- CHECK IF USER IS AUTHENTICATED AND SHOW ADMIN TOOL BAR -->
	<?php if (WebSecurity::isAuthenticated($mysqli)): ?>
	<div style="padding: 15px 0; background-color:#000">
		<a href="#" id="SaveContentChanges">Save</a>
	</div>
	<?php endif; ?>

	<?php
	for ($i = 0; $i < sizeOf($listings); $i++) {
		$listing = $listings[$i];
	?>
		<?php echo($listing->Id) ?><br>
		<img width="100px" class="lazy" src="<?php echo(SITE_ROOT . "uploads/" . $listing->Images[0]) ?>" alt="..."><br/>
		$<?php echo(number_format($listing->Price, 0, '.', ',')); ?>
		<?php echo($listing->Address) ?>, <?php echo($listing->City) ?><br>
		<?php echo($listing->Bedrooms) ?> bed / <?php echo($listing->Bathrooms) ?> bath / <?php echo($listing->LivingSpace) ?> sq. ft
		<hr/>
	<?php
	} 
	?>

	<ul>
	<?php
	for ($i = 0; $i < ($totalListings/$pageSize); $i++) {
		$listing = $listings[$i];
	?>
		<li><a href="<?php echo(SITE_ROOT . 'listings.php?page=' . ($i + 1)); ?>"><?php echo($i + 1); ?></a></li>
	<?php
	} 
	?>
	</ul>

	<!-- CHECK IF USER IS AUTHENTICATED AND INITIALIZE WYSIWYG EDITOR -->
	<?php if (WebSecurity::isAuthenticated($mysqli)): ?>
		<script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
		<script src="content/js/textboxio.js"></script> 
		<?php 
			echo('<script>var SITE_ROOT = "'. SITE_ROOT .'";</script>'); 
		?>
		<script src="<?php echo(SITE_ROOT . 'secure/content/js/main.js') ?>"></script> 
		<script>
			re.views.secure.cms.init();
		</script>
	<?php endif; ?>
	</body>
</html>
