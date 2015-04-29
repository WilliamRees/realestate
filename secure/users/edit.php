<?php
include_once '../authorize.php';
include_once '../../includes/config.php';
include_once '../../includes/register.inc.php';
include_once '../../includes/functions.php';
require_once '../secureheader.php';

if (!isset($_GET["id"])) {
    //header('Location: ' . SITE_ROOT . "secure/users"); 
}

$user = WebSecurity::users($_GET["id"]);

if ($user == null) {
    //header('Location: ' . SITE_ROOT . "secure/users"); 
}

?>

    
        <div class="container">
            <div class="col-md-6 col-md-offset-3">
                <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
                ?>

                <form id="RegisterForm" action="" method="post" name="registration_form" commandname="update">
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type='text' name='username' id='username' placeholder="Username:" class="form-control" required value="<?php echo $user->Username ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" name="email" id="email" placeholder="Email:" class="form-control" required
                        value="<?php echo $user->Email ?>" />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Update" class="btn btn-primary" />
                    </div>
                </form>
                <form id="RegisterForm" action="register.php" method="post" name="registration_form">
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" name="password" id="password" placeholder="Password:" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for=""confirmpwd>Confirm password:</label>
                        <input type="password" name="confirmpwd" id="confirmpwd" placeholder="Confirm password:" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" class="btn btn-primary" />
                    </div>
                </form>
                <p>Return to the <a href="<?php echo(SITE_ROOT . 'secure/login'); ?>">login page</a>.</p>
            </div>
        </div>
        
        
        

<?php include_once '../footerscripts.php' ?>
<script>
    //re.views.secure.users.register.init();
</script>
<?php include_once '../footer.php' ?>