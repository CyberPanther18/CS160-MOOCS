<?php
if (isset ( $_POST ["course_id"] )) {
	session_start ();
	$user_id = $_SESSION ["user_id"];
	$course_id = $_POST ["course_id"];
	require "./config.php";
	
	$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );
	
	if ($con->connect_error) {
		die ( "Connection to Database failed: " . $con->connect_error );
	} else {
		$sql = "INSERT INTO user_courses (user_id, course_id, active) VALUES(" . $user_id . ", " . $course_id . ", 'yes')";
		if ($con->query ( $sql ) === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . $con->error;
		}
	}
	mysqli_close ( $con );
}

?>