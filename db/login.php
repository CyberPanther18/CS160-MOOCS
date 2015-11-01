<?php
session_start(); 

$email = $_POST["email"];
$password = $_POST["password"];
// To protect MySQL injection for Security purpose
$email = stripslashes($email);
$password = stripslashes($password);

require "connect.php";

$sql = "SELECT * FROM users WHERE email = '".$email."' AND password = '".$password."'";

$result = $con->query($sql);
if($result->num_rows > 0):
	while($row = $result->fetch_assoc()):
		$_SESSION["name"] = $row["first_name"];
		header("Location: ../browse.php");
		die();
	endwhile;
else:
	echo "0 results";
endif;
require "disconnect.php";
?>