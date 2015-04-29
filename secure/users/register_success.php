<?php
include_once '../authorize.php';
include_once '../../includes/config.php';
include_once '../../includes/register.inc.php';
include_once '../../includes/functions.php';
require_once '../secureheader.php';
?>

<div class="container">
    <div class="col-md-6 col-md-offset-3">
    	<h1>Registration successful!</h1>
		<p>You can now go back to the <a href="login.php">login page</a> and log in</p>
    </div>
</div>

<?php include_once '../footerscripts.php' ?>
<?php include_once '../footer.php' ?>