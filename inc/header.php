<?php 
session_start(); 
if(isset($_SESSION["name"])):
	$isLoggedIn = true;
else:
	$isLoggedIn = false;
endif;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $TITLE; ?></title>
<!-- Stylesheets -->
<link rel="stylesheet" href="./css/stylesheet.css"/>
<!-- Javascript -->
<script type="application/javascript" src="./js/jquery-2.1.4.min.js"></script>
<script type="application/javascript" src="./js/functions.js"></script>
</head>
<body>
<header>
  <nav id="nav_main">
    <div class="leftcolumn"><a class="load" href="#" data-target="home">
      <h2>Ulearn</h2>
      </a></div>
    <div class="middlecolumn"><form id="search"><input type="search" id="search_main"/><input type="submit" id="search_button" value="Search" class="button-secondary"></form></div>
    <div class="rightcolumn"> <a class="load" href="#" data-target="browse">
      <div class="button button-primary"> Browse </div>
      </a></div>
  </nav>
  <nav id="nav_user">
  <ul class="user_options rightcolumn">
    <?php if(!$isLoggedIn): ?>
      <li><a class="load" href="#" data-target="login"> Login </a> </li>
      <li><a class="load" href="#" data-target="register"> Register </a> </li>
    <?php else: ?>
     <li> <a href="./db/logout.php" target="_self"> Logout </a></li>
    <?php endif; ?>
    </ul>
  </nav>
</header>
