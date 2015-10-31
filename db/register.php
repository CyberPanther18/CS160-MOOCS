<?php
session_start(); 

$firstname = $_POST["firstname"];
$lastname = $_POST["lastname"];
$email = $_POST["email"];
$password = $_POST["password"];

require "connect.php";
$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('".$firstname."', '".$lastname."', '".$email."', '".$password."')";

if (mysqli_query($con, $sql)):
	$_SESSION["name"] = ucfirst($firstname);
	header("Location: ../browse.php");
	die();
else:
	echo "Error: ".$sql.mysqli_error($con);
endif;
require "disconnect.php";
?>