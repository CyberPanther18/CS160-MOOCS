<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_database = "ulearn";

$con = new mysqli($db_host, $db_username, $db_password, $db_database);

if($con->connect_error):
	die("Connection to Database failed: ". $con->connect_error);
endif;
?>