<?php
include_once '../../includes/config.php';
include_once '../../includes/db_connect.php';
include_once '../../includes/WebSecurity.php';

?>

<!DOCTYPE html>
<html> 
	<head>   
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" />
        <link href="../content/css/jquery.typeahead.css" type="text/css" rel="stylesheet" />
        <link href="../content/css/ladda-themeless.min.css" rel="stylesheet">
        <link href="../content/css/textboxio.css" rel="stylesheet">
		    <link href="../content/css/main.css" type="text/css" rel="stylesheet" />
 	</head>
	<body>
		<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://www.mustafazia.com">MustafaZia.com</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo(SITE_ROOT); ?>">CMS</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Listings <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo(SITE_ROOT . 'secure/listing'); ?>">All</a></li>
            <li><a href="<?php echo(SITE_ROOT . 'secure/listing/new.php') ?>">New</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Users <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo(SITE_ROOT . 'secure/users/'); ?>">All</a></li>
            <li><a href="<?php echo(SITE_ROOT . 'secure/users/register.php') ?>">New</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav pull-right">
        <li><p class="navbar-text"><?php echo($_SESSION['user']->Username); ?></p></li>
        <li><a href="<?php echo(SITE_ROOT . 'includes/logout.php'); ?>">log out</a></li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<div class="container">
  <div class="row">
  <div class="col-md-12">
    <div id="ErrorSummary" class="alert alert-danger alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <div class="inner">
        
      </div>
    </div>
  </div>
</div>
</div>

