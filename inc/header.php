<!doctype html>

<?php 
session_start();

require "/db/config.php";

$con = new mysqli($db_host, $db_username, $db_password, $db_database);

if($con->connect_error):
	die("Connection to Database failed: ". $con->connect_error);
endif;

if(isset($_SESSION["name"])):
	$isLoggedIn = true;
else:
	$isLoggedIn = false;
endif;
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo $TITLE; ?></title>
<!-- Stylesheets -->
<link rel="stylesheet" href="./css/stylesheet.css"/>
<link rel="stylesheet" type="text/css" href="./plugins/datatables/datatables.min.css">
<!-- Javascript -->
<script type="application/javascript" src="./js/jquery-2.1.4.min.js"></script>
<script type="application/javascript" src="./js/jquery-ui.min.js"></script>
<script type="application/javascript" src="./js/functions.js"></script>
</head>
<body>
<header>
  <nav id="nav_main" class="columns">
    <div class="leftcolumn"><a href="./index.php">
      <h1>Ulearn</h1>
      </a></div>
    <div class="middlecolumn">
      <form id="search">
        <input type="search" id="search_main"/>
        <input type="submit" id="search_button" value="Search" class="button-secondary">
      </form>
    </div>
    <div class="rightcolumn"> <a href="./browse.php">
      <div class="button button-primary"> Browse </div>
      </a></div>
  </nav>
  <nav id="nav_user">
    <ul class="user_options rightcolumn">
      <?php if(!$isLoggedIn): ?>
      <li><a class="load" href="#" data-target="login"> Login </a> </li>
      <li><a class="load" href="#" data-target="register"> Register </a> </li>
      <?php else: ?>
       <li> <a href="./user/account.php" data-target="_self"> <?php echo ucfirst($_SESSION["name"]); ?> </a></li>
      <li> <a class="load" href="#" data-target="mycourses"> My Courses </a></li>
      <li> <a href="./db/logout.php" target="_self"> Logout </a></li>
      <?php endif; ?>
    </ul>
  </nav>
</header>
<main id="content">
<!--Slider -->
<aside id="slider">
<!--<aside id="sliderclose"></aside>-->
<div id="slidercontent">
</div>
</aside>
