<?php
if (isset ( $_POST ["rating"] )) {
	header ( 'Content-Type: application/json' );
	$rating = $_POST ["rating"];
	
	require "./config.php";
	$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );
	if ($con->connect_error) {
		die ( "Connection to Database failed: " . $con->connect_error );
	} else {
		$sql = "INSERT INTO course_ratings (user_id, course_id, rating) VALUES ('" . $rating ["user_id"] . "', '" . $rating ["course_id"] . "', '" . $rating ["rating"] . "')";
		if (mysqli_query ( $con, $sql )) {
			echo '{"status":"succesfull"}';
		} else {
			echo '{"status":"error"}';
		}
	}
}
?>