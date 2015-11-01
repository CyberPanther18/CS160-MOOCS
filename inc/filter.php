<aside id="filter">
  <h3>Refine By</h3>
  <h4>Service</h4>
  <ul class="refinement select" id="service">
    <li><span>Future Learn</span></li>
    <li><span>Udacity</span></li>
  </ul>
  <h4>Subject</h4>
  <ul class="refinement select" id="subject">
    <li><span>Business & Management</span></li>
    <li><span>Computer Science</span></li>
    <li><span>Creative Arts & Media</span></li>
  </ul>
  <h4>Class-Type</h4>
  <ul class="refinement choice" id="classtype">
    <li><span>Free</span></li>
    <li><span>Premium</span></li>
  </ul>
  <h4>Avg. User Review</h4>
  <ul class="refinement choice" id="userreview">
    <li> * * * * & Up </li>
    <li> * * * & Up </li>
    <li> * * & Up </li>
    <li> * & Up </li>
  </ul>
  <h4>University</h4>
  <ul class="refinement select" id="university">
    <li><span>San Jose State University</span></li>
  </ul>
  <h4>Availablility</h4>
  <ul class="refinement select" id="availability">
    <li><span>Now</span></li>
    <li><span>Online</span></li>
    <li><span>Fall</span></li>
    <li><span>Spring</span></li>
  </ul>
</aside>
<script type="application/javascript">
	$(".refinement li").click(function(){
		$category = $(this).parent().attr('id');
		$value = $(this).children("span").text();
		console.log($value);
	});
</script>
