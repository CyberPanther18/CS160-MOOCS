<?php
session_start ();

$email = $_POST ["email"];
$password = $_POST ["password"];
// To protect MySQL injection for Security purpose
$email = stripslashes ( $email );
$password = stripslashes ( $password );

require "./config.php";

$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );

if ($con->connect_error) :
	die ( "Connection to Database failed: " . $con->connect_error );




endif;

$sql = "SELECT * FROM users WHERE email = '" . $email . "' AND password = '" . $password . "'";

$result = $con->query ( $sql );
if ($result->num_rows > 0) :
	while ( $row = $result->fetch_assoc () ) {
		$_SESSION ["user_id"] = $row ["id"];
		$_SESSION ["name"] = $row ["first_name"];
		header ( "Location: ../browse.php" );
		die ();
	}
 else :
	header ( "Location: ../index.php" );
endif;
mysqli_close ( $con );
?>