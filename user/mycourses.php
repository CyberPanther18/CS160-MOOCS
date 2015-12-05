<section>	
	<?php
	session_start ();
	$user_id = $_SESSION ["user_id"];
	require "../db/config.php";
	$con = new mysqli ( $db_host, $db_username, $db_password, $db_database );
	$mycourses_sql = "SELECT * FROM user_courses WHERE user_id = " . $user_id;
	$mycourses_result = $con->query ( $mycourses_sql );
	if ($mycourses_result->num_rows > 0) {
		echo "<ul id='my_courses'>";
		while ( $row = $mycourses_result->fetch_assoc () ) {
			$courses_sql = "SELECT * FROM course_data WHERE id = " . $row ["course_id"];
			$courses_result = $con->query ( $courses_sql );
			
			while ( $course = $courses_result->fetch_assoc () ) {
				echo "<li><a href='" . $course ["course_link"] . "' target='_blank'><p class='course_title'>" . $course ["title"] . "<span class='by'> (" . $course ["site"] . ")</span></p></a></li>";
			}
		}
		echo "</ul>";
	} else {
		echo "<h2>Add some courses!</h2>";
	}
	mysqli_close ( $con );
	?>
	 <div class="button close">Close</div>
</section>