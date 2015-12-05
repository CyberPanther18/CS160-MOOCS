<?php
$TITLE = "Browse";
require "./inc/header.php";
?>
<aside id="sidebar">
	<ul id="subjects" class="filter">
		<li><div class="vertical-divider architecture"></div> <a href="#"
			data-target="architecture">Architecture</a></li>
		<li><div class="vertical-divider arts"></div> <a href="#"
			data-target="arts & cultures">Arts & Cultures</a></li>
		<li><div class="vertical-divider astronomy"></div> <a href="#"
			data-target="astronomy">Astronomy</a></li>
		<li><div class="vertical-divider aviation"></div> <a href="#"
			data-target="aviation">Aviation</a></li>
		<li><div class="vertical-divider business"></div> <a href="#"
			data-target="business">Business</a></li>
		<li><div class="vertical-divider chemistry"></div> <a href="#"
			data-target="chemistry">Chemistry</a></li>
		<li><div class="vertical-divider computer"></div> <a href="#"
			data-target="computer science">Computer Science</a></li>
		<li><div class="vertical-divider data"></div> <a href="#"
			data-target="data science">Data Science</a></li>
		<li><div class="vertical-divider earth"></div> <a href="#"
			data-target="earth science">Earth Science</a></li>
		<li><div class="vertical-divider economics"></div> <a href="#"
			data-target="economics">Economics</a></li>
		<li><div class="vertical-divider education"></div> <a href="#"
			data-target="education">Education</a></li>
		<li><div class="vertical-divider engineering"></div> <a href="#"
			data-target="engineering">Engineering</a></li>
		<li><div class="vertical-divider entrepreneurship"></div> <a href="#"
			data-target="entrepreneurship">Entrepreneurship</a></li>
		<li><div class="vertical-divider health"></div> <a href="#"
			data-target="health science">Health Science</a></li>
		<li><div class="vertical-divider history"></div> <a href="#"
			data-target="history">History</a></li>
		<li><div class="vertical-divider law"></div> <a href="#"
			data-target="law">Law</a></li>
		<li><div class="vertical-divider life"></div> <a href="#"
			data-target="life science">Life Science</a></li>
		<li><div class="vertical-divider mathematics"></div> <a href="#"
			data-target="mathematics">Mathematics</a></li>
		<li><div class="vertical-divider marketing"></div> <a href="#"
			data-target="marketing">Marketing</a></li>
		<li><div class="vertical-divider personal"></div> <a href="#"
			data-target="personal development">Personal</a></li>
		<li><div class="vertical-divider philosophy"></div> <a href="#"
			data-target="philosophy & ethics">Philosophy & Ethics</a></li>
		<li><div class="vertical-divider physical"></div> <a href="#"
			data-target="physical science">Physical Science</a></li>
		<li><div class="vertical-divider political"></div> <a href="#"
			data-target="political science">Political Science</a></li>
		<li><div class="vertical-divider psychology"></div> <a href="#"
			data-target="psychology">Psychology</a></li>
		<li><div class="vertical-divider social"></div> <a href="#"
			data-target="social science">Social Science</a></li>
		<li><div class="vertical-divider sports"></div> <a href="#"
			data-target="sports">Sports</a></li>
		<li><div class="vertical-divider other"></div> <a href="#"
			data-target="other">Other</a></li>
	</ul>

</aside>

<aside id="toolbar">

	<ul id="services" class="filter">
		<li><a href="#" data-target="coursera">Coursera</a></li>
		<li><a href="#" data-target="udacity">Udacity</a></li>
		<li><a href="#" data-target="futurelearn">FutureLearn</a></li>
		<li><a href="#" data-target="edx">edX</a></li>
		<li><a href="#" data-target="novoed">NovoEd</a>
		
		<li><a href="#" data-target="iversity">iversity</a></li>
		<li><a href="#" data-target="canvas">Canvas</a></li>
		<li><a href="#" data-target="open2study">Open2Study</a></li>
	</ul>
	<div id="search_bar">
		<input type="search" id="search" placeholder="&Uuml; Search" />
	</div>

</aside>
<section id="main">
	<section id="course_list">Select a filter to get started.</section>

	<script>
		 
$(document).ready(function(){
	var filters = {search:"", subjects :[], services: []};

	$("#search").keyup(function(){
		var value = $(this).val().toLowerCase();
		filters.search = value;
		console.log(JSON.stringify(filters));
		applyFilter();
		/*filters.search = value;
		console.log(filters.search);
		$.each($("#courses tbody").find("tr"), function() {
			if($(this).text().toLowerCase().indexOf(value) == -1){
				$(this).hide();
			}
		    else{
		        $(this).show();      
		    }          
		}); */
	});
		
	 $("#subjects li a").click(function(){
			var subject = $(this).data('target');
			if($(this).parent().hasClass("isFilter")){
				$(this).parent().removeClass("isFilter");
				for(var i = 0; i < filters.subjects.length; i++){
					if(filters.subjects[i] == subject){
						filters.subjects.splice(i, 1);
						break;
					}
				}
			} else{
				$(this).parent().addClass("isFilter");
				filters.subjects.push(subject);
			}
			$("#course_list").html("Loading...");
			applyFilter();
	 });	
	 $("#services li a").click(function(){
			var service = $(this).data('target');
			if($(this).parent().hasClass("isFilter")){
				$(this).parent().removeClass("isFilter");
				for(var i = 0; i < filters.services.length; i++){
					if(filters.services[i] == service){
						filters.services.splice(i, 1);
						break;
					}
				}
			} else{
				$(this).parent().addClass("isFilter");
				filters.services.push(service);
			}
			$("#course_list").html("Loading...");
			applyFilter();
	});
	 <?php
		
		if ($isLoggedIn) {
			?>
				var user_id = <?php echo $user_id; ?>;
				$("#main").on("click", ".ratings a", function(){
					var id = $(this).data('id');
					var rating = $(this).data('value');
					var json_rating= {"user_id":user_id, "course_id": id, "rating":rating};
					var $this = $(this);
					$.ajax({
						type: "POST",
						dataType: "json",
						url: "./db/setrating.php",
						data: {"rating":json_rating},
						success: function(data){
							console.log(data);
							$("#course_list").html("Loading...");
							applyFilter();
						},
						error: function(e){
							console.log("ERROR: "+e.responseText);
						}
					});
				});
					$("#main").on("click", "a.add_course", function(){
						var target = $(this).data('target');
						var $this = $(this);
						$.ajax({
							type: "POST",
							url: "./db/addcourse.php",
							data: { "course_id": target },
							success: function (res) {
								var course_added = "<p class='course_added'>My Courses</p>";
								$this.fadeOut("fast", function(){
									$this.after(course_added);
								});
				
							},
							error: function (res) {
							}
						});
							return false;
					}); 
				<?php }?>

	 function applyFilter(){
		 $.ajax({
	            type: "POST",
	            dataType: "json",
	            url: "./db/getcourses.php",
	            data: {"filters":filters},
	            success: function(data){
	            	console.log(data);
	            	//var json = jQuery.parseJSON(data);
	            	$("#course_list").html(jsonToTable(data));
	            },
	            error: function(e){
	            	  console.log("ERROR: "+e.responseText);
	            }
	    });
	 }
	 function jsonToTable (json){
		 if(jQuery.isEmptyObject(json))
			 return "<p>No courses met your criteria</p>";
		 
		var table = "<table id='courses'><tbody>";
		$.each(json, function(i, course){
			var category = "no-subject";
			var course_image = "./images/tempU.png";
			if(course.category != "")
				category = course.category.toLowerCase();
			if(course.course_image != "")
				course_image = course.course_image;
			// Course Row
			table += "<tr class='course_row'>";
			table += "<td><div class='vertical-divider "+category+"'></div></td>";
			// Image
			table += "<td class='course_image'><img src='"+course_image+"'/></td>";
			// Title
			table += "<td class='course_description'><a href='"+ course.course_link + "' target='_blank'><p class='course_title'>" + course.title + "<span class='by'> (" + course.site+ ")</span></p></a>";
			// Rating
			table += "<div class='leftcolumn'>";
			if(course.rating.average > 0){
				table += "<p class='course_rating'>Ratings: <span class='rating'>"+course.rating.average + "</span><span class='rating_out_of'>/5</span><span class='course_count'> from "+course.rating.count;
				if(course.rating.count > 1)
					table+=" users";
				else
					table +=" user";
			table+= "</span></p>";
			}
			table += "</div>";
			table += "</div><div class='middlecolumn'>";
			//Star Ratings
			<?php
			if ($isLoggedIn) {
				?>
			table += "<div class='ratings'>Rate: <a href='#' data-id='"+course.id+"' data-value='1'>1</a><a href='#' data-id='"+course.id+"' data-value='2'>2</a><a href='#' data-id='"+course.id+"' data-value='3'>3</a><a href='#' data-id='"+course.id+"' data-value='4'>4</a><a href='#' data-id='"+course.id+"' data-value='5'>5</a></div>";
			<?php } ?>
			table += "</div>";
			// Category
			table += "<div class='rightcolumn'>";
			table += "<p>"+course.category+"</p>"
			table += "</div>";
			// Description
			table += "<p class='course_short_desc'>" + course.short_desc + "</p>";
			// University
			table += "<div class='leftcolumn'>";
			if (course.university != "")
				table += "<p class='course_university'>" + course.university + "</p>";
			// Price
			table += "</div><div class='middlecolumn'>";
			if(course.course_fee > 0)
				table += "<p class='course_price'>$"+course.course_fee+"</p>";
			table += "</div>";
			// Add Course
			table += "<div class='rightcolumn'>";
		 <?php
			if ($isLoggedIn) {
				?>
				table += "<a href='#' class='add_course' data-target='" + course.id + "'><div class='button button-alternate'>Add Course</div></a>";
			 <?php } ?>
					
			table += "</div></td>";
			// Professors
			table += "<td class='course_professors'><h5>Professors</h5><ul class='professors'>";
			$.each(course.professors, function(i, professor){
				table += "<li><img class='thumbnail_small' src='"+professor.profimage+"'/><span class='professor_name'>"+professor.profname+"</span></li>";
			});
			table += "</ul></td>";
			table += "</tr>";
		});
		table+="</tbody></table>";
		return table;
		 
	 }
		function hideAll(){
			$("table#courses tr").each(function() {
				$(this).hide();
			});
		}
		function showAll(){
			$("table#courses tr").each(function() {
				$(this).show();
			});
		}
		
	});
</script>
</section>
<?php
require "./inc/footer.php";
?>