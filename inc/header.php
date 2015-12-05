<!doctype html>

<?php
session_start ();

require "./db/config.php";

$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );

if ($con->connect_error) :
	die ( "Connection to Database failed: " . $con->connect_error );






endif;

header ( 'Content-Type: text/html; charset=utf-8' );
$con->set_charset ( 'utf8' );

if (isset ( $_SESSION ["name"] )) :
	$isLoggedIn = true;
	$user_id = $_SESSION ["user_id"];
 else :
	$isLoggedIn = false;
endif;
?>
<html>
<head>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<title>ULearn - <?php echo $TITLE; ?></title>
<!-- Stylesheets -->
<link rel="stylesheet" href="./css/stylesheet.css" />
<!-- Javascript -->
<script type="application/javascript" src="./js/jquery-2.1.4.min.js"></script>
<script type="application/javascript" src="./js/jquery-ui.min.js"></script>
<script type="application/javascript" src="./js/functions.js"></script>
</head>
<body>
	<header class="columns">
		<div class="leftcolumn">
			<a href="./index.php">
				<h1 class="logo">&Uuml;LEARN</h1>
			</a>
		</div>
		<div class="middlecolumn">

		&nbsp;

		</div>
		<div class="rightcolumn">
			<nav id="nav_user">
				<ul class="user_options">
					<li><a href="./browse.php">Browse </a></li>
      <?php if(!$isLoggedIn): ?>
      <li><a class="load" href="#" data-target="login"> Login </a></li>
					<li><a class="load" href="#" data-target="register"> Register </a></li>
      <?php else: ?>
       <!-- <li><a href="./user/account.php" data-target="_self"> <?php echo ucfirst($_SESSION["name"]); ?> </a></li> -->
					<li><a href="#" class="load" data-target="mycourses"> My Courses </a></li>
					<li><a href="./db/logout.php" target="_self"> Logout </a></li>
      <?php endif; ?>
    </ul>
			</nav>

		</div>
	</header>
	<main id="content"> <!--Slider -->
	<aside id="slider">
		<!--<aside id="sliderclose"></aside>-->
		<div id="slidercontent"></div>
	</aside>