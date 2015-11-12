<?php
$sql = "SELECT * FROM course_data";

if (! isset ( $type )) :
	$type = "all";


endif;

$result = $con->query ( $sql );

if ($result->num_rows > 0) {
	echo '<table id="courses">';
	// Show Minimalized Browse
	if ($type == "browse") :
		echo '<thead><tr><th>Image</th><th>Course Description</th></tr></thead>';
		while ( $row = $result->fetch_assoc () ) :
			echo "<tr>
		<td class='course_image'><img src='" . $row ["course_image"] . "'/></td>
		<td class='course_desc'><h3 class='course_title'>" . $row ["title"] . "</h3>
				<p class='course_short_desc'>" . $row ["short_desc"] . "</p>
						<a href='#'><div class='button button-alternate'>Add Course</div></a></td>
	</tr>";
		endwhile
		;
	 	// Show All Courses
	else :
		echo '
<thead>
  <tr>
	<th>ID</th>
    <th>Title</th>
	<th>Short Desc</th>
	<th>Long Desc</th>
	<th>Course Link</th>
	<th>Video Link</th>
	<th>Start Date</th>
	<th>Course Length</th>
	<th>Course Image</th>
	<th>Category</th>
	<th>Site</th>
	<th>Course Fee</th>
	<th>Language</th>
	<th>Certificate</th>
	<th>University</th>
	<th>Time Scraped</th>
	</tr>
	</thead>';
		while ( $row = $result->fetch_assoc () ) :
			echo "<tr>
        <td>" . $row ["id"] . "</td>
		<td>" . $row ["title"] . "</td>
		<td>" . $row ["short_desc"] . "</td>
		<td>" . $row ["long_desc"] . "</td>
		<td>" . $row ["course_link"] . "</td>
		<td>" . $row ["video_link"] . "</td>
		<td>" . $row ["start_date"] . "</td>
		<td>" . $row ["course_length"] . "</td>
		<td>" . $row ["course_image"] . "</td>
		<td>" . $row ["category"] . "</td>
		<td>" . $row ["site"] . "</td>
		<td>" . $row ["course_fee"] . "</td>
		<td>" . $row ["language"] . "</td>
		<td>" . $row ["certificate"] . "</td>
		<td>" . $row ["university"] . "</td>
		<td>" . $row ["time_scraped"] . "</td>
	</tr>";
		endwhile
		;
	endif;
	echo "</table>";
} else {
	echo "<p>0 results</p>";
}
?>
