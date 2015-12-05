<?php
if (isset ( $_POST ["filters"] )) {
	header ( 'Content-Type: application/json' );
	$filters = $_POST ["filters"];
	
	if (! empty ( $filters ['subjects'] )) {
		$sql_subjects = " WHERE ";
		for($i = 0; $i < count ( $filters ['subjects'] ); $i ++) {
			if ($i > 0)
				$sql_subjects .= " OR ";
			else
				$sql_subjects .= " ( ";
			$sql_subjects .= "category ='" . $filters ['subjects'] [$i] . "'";
		}
		$sql_subjects .= " ) ";
	} else
		$sql_subjects = "";
	
	$sql_services = "";
	if (! empty ( $filters ['services'] )) {
		if ($sql_subjects == "")
			$sql_services = " WHERE ";
		else
			$sql_services = " AND (";
		
		for($i = 0; $i < count ( $filters ['services'] ); $i ++) {
			if ($i > 0)
				$sql_services .= " OR ";
			$sql_services .= " site = '" . $filters ['services'] [$i] . "'";
		}
		if ($sql_subjects != "")
			$sql_services .= " ) ";
	}
	$sql_search = "";
	if ($filters ['search'] != "") {
		if (empty ( $filters ['services'] ) && empty ( $filters ['services'] )) {
			$sql_search = " WHERE ";
		}
		if (! empty ( $filters ['services'] ) || ! empty ( $filters ['subjects'] )) {
			$sql_search = " AND ";
		}
		$sql_search .= " title LIKE '%" . $filters ['search'] . "%'";
	}
	// Database Connection
	require "./config.php";
	$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );
	
	if ($con->connect_error) {
		die ( "Connection to Database failed: " . $con->connect_error );
	} else {
		// SQL Statement
		$sql_courses = 'SELECT * FROM course_data' . $sql_subjects . $sql_services . $sql_search;
		// SQL Query
		mysqli_set_charset ( $con, "utf8" );
		$result = $con->query ( $sql_courses );
		// Create JSON file filled with courses
		$courses = '[';
		if ($result->num_rows > 0) {
			$i = 0;
			while ( $row = $result->fetch_assoc () ) {
				if ($i > 0)
					$courses .= ",";
				$course = '{';
				$course .= '"id":' . $row ["id"];
				$course .= ', "title":' . json_encode ( $row ["title"] );
				$course .= ', "short_desc":' . json_encode ( $row ["short_desc"] );
				$course .= ', "long_desc":' . json_encode ( $row ['long_desc'] );
				$course .= ', "course_link":"' . $row ["course_link"] . '"';
				$course .= ', "video_link":"' . $row ["video_link"] . '"';
				$course .= ', "start_date":"' . $row ["start_date"] . '"';
				$course .= ', "course_length":' . $row ["course_length"];
				$course .= ', "course_image":"' . $row ["course_image"] . '"';
				$course .= ', "category":"' . $row ["category"] . '"';
				$course .= ', "site":"' . $row ["site"] . '"';
				$course .= ', "course_fee":' . $row ["course_fee"];
				$course .= ', "language":"' . $row ["language"] . '"';
				$course .= ', "certificate":"' . $row ["certificate"] . '"';
				$course .= ', "university":"' . $row ["university"] . '"';
				$course .= ', "time_scraped":"' . $row ["time_scraped"] . '"';
				// Course Professors
				$sql_professors = "SELECT * FROM coursedetails WHERE course_id = " . $row ["id"];
				$result_professors = $con->query ( $sql_professors );
				$professors = ', "professors":[';
				$j = 0;
				if ($result_professors->num_rows > 0) {
					while ( $professor = $result_professors->fetch_assoc () ) {
						if ($j > 0)
							$professors .= ",";
						$professors .= "{";
						$professors .= '"id":' . $professor ["id"];
						$professors .= ', "profname":' . json_encode ( $professor ["profname"] );
						$professors .= ', "profimage":"' . $professor ["profimage"] . '"';
						$professors .= "}";
						$j ++;
					}
				}
				$professors .= "]";
				$course .= $professors;
				// Course Rating
				$sql_rating = "SELECT TRUNCATE(AVG(rating), 1), COUNT(rating) FROM course_ratings WHERE course_id = " . $row ['id'];
				$result_rating = $con->query ( $sql_rating );
				$rating = ', "rating":';
				if ($result_rating->num_rows > 0) {
					while ( $ratings = $result_rating->fetch_assoc () )
						$rating .= '{"average":"' . $ratings ["TRUNCATE(AVG(rating), 1)"] . '", "count":"' . $ratings ["COUNT(rating)"] . '"}';
				}
				$course .= $rating;
				$course .= '}';
				$i ++;
				$courses .= $course;
			}
		}
		$courses .= ']';
		echo $courses;
	}
	mysqli_close ( $con );
}
?>