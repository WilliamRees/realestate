<?php
include_once '../../includes/config.php';
include_once '../../includes/WebSecurity.php';
 
WebSecurity::sec_session_start();
 
if (WebSecurity::isAuthenticated($mysqli) == true) {
    $logged = 'in';
} else {
    $logged = 'out';
}

$loginresult;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'], $_POST['p'])) {
        $email = $_POST['email'];
        $password = $_POST['p'];

        if (WebSecurity::login($email, $password, $mysqli) == true) {
            header('Location: ' . LOGIN_SUCCESS);
        } else {
            header('Location: ' . LOGIN_ERROR);
        }
    } else {
        header('Location: ' . ERROR);
        exit;
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
    </head>
    <body>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="#">
            <img alt="Brand" src="...">
          </a>
        </div>
      </div>
    </nav>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                    if (isset($_GET['error'])) {

                        echo '<div class="alert alert-danger" role="alert"><p>Invalid username or password</p></div>';
                    }
                    ?> 
                    <form id="LoginForm" action="index.php" method="post" name="login_form">                      
                        <div class="form-group">
                            <label for="Email">Email:</label>
                            <input id="Email" type="email" name="email" required class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" required class="form-control" />
                        </div> 
                        <div class="form-group">
                            <input type="submit" value="login" class="btn btn-primary" />
                        </div>
                    </form>
                    <p>You are currently logged <?php echo $logged ?>.</p>
                </div>
            </div>
        </div>
        <?php include_once '../footerscripts.php' ?>
        <script>
            $(function(){
                re.views.secure.login.init();
            });
        </script>
    </body>
</html>