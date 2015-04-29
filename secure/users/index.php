<?php
include_once '../authorize.php';
include_once '../../includes/config.php';
include_once '../../includes/register.inc.php';
include_once '../../includes/functions.php';
require_once '../secureheader.php';

$users = WebSecurity::users();



?>

<div class="container">
	<?php if(isset($_SESSION['message'])) : ?>
	    <div class="col-md-6 col-md-offset-3">
	    	<div class="alert alert-success" role="alert">
	    		<?php 
	    			echo $_SESSION['message'];
	    			unset($_SESSION['message']);
	    		?>
	    	</div>
	    </div>
	<?php endif; ?>

	<?php if(count($users) < 2) : ?>
	<div class="col-md-6 col-md-offset-3">
		<p>
			There are no additional users. Try creating a new user at <a href="<?php echo SITE_ROOT . "secure/users/register.php" ?>"><?php echo SITE_ROOT . "users/register.php" ?></a>
		</p>
	</div>
	<?php else : ?>
    <div class="col-md-6 col-md-offset-3">
    	<div class="table-responsive">
	    	<table class="table table-striped">
	    		<tr>
	    			<th>Id</th>
	    			<th>Username</th>
	    			<th>Email</th>
	    			<th></th>
	    		</tr>
	    		<?php foreach($users as $key=>$value): ?>
    			<?php if($users[$key]->Id != $_SESSION['user']->Id) : ?>
	    		<tr valign="center" data-user-id="<?php echo $users[$key]->Id ?>">
	    			<td><?php echo $users[$key]->Id ?></td>
	    			<td><?php echo $users[$key]->Username ?></td>
	    			<td><?php echo $users[$key]->Email ?></td>
	    			<td align="right">
	    				<a href="<?php echo SITE_ROOT . "secure/users/edit.php?id=" . $users[$key]->Id ?>" class="btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Edit</a>
	    				<a href="#delete" class="btn btn-warning" role="button" data-user-remove="<?php echo $users[$key]->Id ?>"><span class="glyphicon glyphicon-trash"></span> Remove</a>
    				</td>
	    		<tr>
	    	<?php endif; ?>
	    		<?php endforeach; ?>
	    	</table>
    	</div>
    </div>
    <?php endif; ?>
</div>

<?php include_once '../footerscripts.php' ?>
<script>
	re.views.secure.users.init();
</script>
<?php include_once '../footer.php' ?>