<?php
session_start ();

$firstname = $_POST ["firstname"];
$lastname = $_POST ["lastname"];
$email = $_POST ["email"];
$password = $_POST ["password"];

require "./config.php";
$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );

if ($con->connect_error) {
	die ( "Connection to Database failed: " . $con->connect_error );
} else {
	
	$sql = "INSERT INTO users (first_name, last_name, email, password) VALUES ('" . $firstname . "', '" . $lastname . "', '" . $email . "', '" . $password . "')";
	
	if (mysqli_query ( $con, $sql )) {
		$select_sql = "SELECT * FROM users WHERE email='" . $email . "' AND password = '" . $password . "'";
		$result = mysqli_query ( $con, $select_sql );
		if ($result->num_rows > 0) {
			while ( $row = $result->fetch_assoc () ) {
				$_SESSION ["user_id"] = $row ["id"];
				$_SESSION ["name"] = $row ["first_name"];
				header ( "Location: ../browse.php" );
				die ();
			}
		} else {
			header ( "Location: ../index.php" );
		}
	}
	mysqli_close ( $con );
}
?>