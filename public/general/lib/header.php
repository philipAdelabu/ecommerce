<?php
  session_start();

$inactive = 800;
if(isset($_SESSION['timeout'])){
  $session_life = time() - $_SESSION['timeout'];
  if($session_life > $inactive){
     session_destroy();
     $_SESSION[] = Array();
    header("Location: ../board/login.html");
    exit;
  }
}
 $_SESSION['timeout'] = time();

  if(!isset($_SESSION['reg_id'])){
      session_destroy();
    $_SESSION[] = Array();
    header("Location: ../board/login.html");
    exit;
  }else{
	  $reg_id = $_SESSION['reg_id'];
	  $name = $_SESSION['name'];
      $cash = $_SESSION['cash'];
	   }
 include("lib/dbcon.php");  
  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Online Shopping cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="themes/less/simplex.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/classified.less">
	<link rel="stylesheet/less" type="text/css" href="themes/less/amelia.less">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="themes/less/bootshop.less">
	<script src="themes/js/less.js" type="text/javascript"></script> -->
	
<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="themes/js/google-code-prettify/prettify.css" rel="stylesheet"/>
<!-- fav and touch icons -->
    <link rel="shortcut icon" href="themes/images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="themes/images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="themes/images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="themes/images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="themes/images/ico/apple-touch-icon-57-precomposed.png">
	<style type="text/css" id="enject"></style>
 
   <link href="loader.css" rel="stylesheet">
  </head>
<body>
<div id="header">
<div class="container">
<div id="welcomeLine" class="row">
	<div class="span6"><b><?php echo $name; ?> !</b>  Your Ballance is : <strong style="color: red;"><?php echo number_format($cash,2); ?></strong></div>
	<div class="span6">
 <div class="pull-right">
    <a href="product_summary.php"><span class="btn btn-mini btn-primary"><i class="icon-shopping-cart icon-white"></i> [<?php echo ($items = (isset($_SESSION['new_product']))? count($_SESSION['new_product']) : 0 ); ?> ] Itemes in your cart </span> </a> 
  </div>
	</div>
</div>
<!-- Navbar ================================================== --><!-- Navbar ================================================== -->
<div id="logoArea" class="navbar">
<a id="smallScreen" data-target="#topMenu" data-toggle="collapse" class="btn btn-navbar">
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
</a>
  <div class="navbar-inner">
    <span class="brand" href="shop.php">Shopping</span>
    <ul id="topMenu" class="nav pull-right">
   <li class=""><a href="shop.php">Latest</a></li>
   <li class=""><a href="products.php">Products</a></li>
    <li class=""><a href="myItems.php">MyItems</a></li>
   <li class=""><a href="contact.php">Delivery</a></li>
   <li class="">
   <a href="#login" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Back</span></a>
  <div id="login" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Back To Dashboard ?</h3>
      </div>
      <div class="modal-body">    
      <button class="btn btn-success"><a href="../board/dashboard.php" style="text-decoration:none; color: white;">Back To My Dashboard</a></button>
      <button class="btn" data-dismiss="modal" aria-hidden="true">No, Not Now</button>
      </div>
  </div>
  </li>
  <li class="">
   <a href="#logout" role="button" data-toggle="modal" style="padding-right:0"><span class="btn btn-large btn-success">Logout</span></a>
  <div id="logout" class="modal hide fade in" tabindex="-1" role="dialog" aria-labelledby="login" aria-hidden="false" >
      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      <h3>Logout ?</h3>
      </div>
      <div class="modal-body">    
      <a role="button" class="btn btn-success" href="../board/logout.php">Logout</a>
      <button class="btn btn-primary btn-large" data-dismiss="modal" aria-hidden="true">Cancle</button>
      </div>
  </div>
  </li>
    </ul>
  </div>
</div>
</div>
</div>
<!-- Header End====================================================================== -->