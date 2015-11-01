<?php
require "./db/connect.php";
$sql = "SELECT name, subject, service, type, description FROM courses";
$result = $con->query($sql);
echo '<ul id="courses">';
if ($result->num_rows > 0) {
    /*		<ul class='school-approval'></ul>
			<ul class='business-approval'></ul> */
    while($row = $result->fetch_assoc()) {
        echo 
	"<li>
		<div class='a-grid'>
			<div class='a-col-left'>
				<img src='./images/course/".$row["name"].".png'/>
			</div>
			<div class='a-col-right'>
				<h3 class='name'>".$row["name"]."</h3>
				<p class='service'>by <span>".$row["service"]."</span></p>
				<p class='description'>".$row["description"]."</p>
			</div>
		</div>
	</li>";
    }
} else {
    echo "0 results";
}
echo '</ul>';
?>