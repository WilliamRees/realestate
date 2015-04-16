<!-- Includes -->
<?php
	include_once 'includes/WebSecurity.php';
	include_once 'includes/config.php';
	require_once("includes/CMSUtility.php");
	WebSecurity::sec_session_start();
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

	<div class="cms-content" data-nodename="Node1">
		<?php
			CMSUtility::ContentLiteral("Node1");
		?>
	</div>
	<div class="cms-content" data-nodename="Node2">
		<?php
			CMSUtility::ContentLiteral("Node2");
		?>
	</div>
	<div class="cms-content" data-nodename="sitebodycopy">
		<?php
			CMSUtility::ContentLiteral("sitebodycopy");
		?>
	</div>
	<div class="cms-content" data-nodename="Node3">
		<?php
			CMSUtility::ContentLiteral("Node3");
		?>
	</div>



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
