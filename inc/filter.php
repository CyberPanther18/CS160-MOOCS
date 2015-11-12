<aside id="filter">
  <h3>Refine By</h3>
  <h4>Service</h4>
  <ul class="refinement select" id="service">
    <li><span>EDX</span></li>
    <li><span>NovaEd</span></li>
  </ul>
  <h4>Subject</h4>
  <ul class="refinement select" id="subject">
    <li><span>Architecture</span></li>
    <li><span>Art & Culture</span></li>
    <li><span>Biology & Life Sciences</span></li>
    <li><span>Business & Management</span></li>
    <li><span>Chemistry</span></li>
    <li><span>Communication</span></li>
    <li><span>Computer Science</span></li>
    <li><span>Creative Arts & Media</span></li>
    <li><span>Education & Teacher Training</span></li>
    <li><span>Humanities</span></li>
    <li><span>Language</span></li>
    <li><span>Law</span></li>
    <li><span>Literature</span></li>
    <li><span>Math</span></li>
    <li><span>Medicine</span></li>
    <li><span>Music</span></li>
    <li><span>Philosophy & Ethics</span></li>
    <li><span>Physics</span>
    <li><span>Science</span></li>
  	<li><span>Social Sciences</span></li>
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
  	<li><span>ACAA</span></li>
    <li><span>Acumen</span></li>
    <li><span>Adelaide</span></li>
    <li><span>Amnesty International</span></li>
    <li><span>ANU</span></li>
    <li><span>ASU</span></li>
    <li><span>Babson Global</span></li>
    <li><span>Berklee</span></li>
    <li><span>BU</span></li>
    <li><span>Carnegie Foundation</span></li>
    <li><span>Catalyst</span></li>
    <li><span>Chalmers</span></li>
    <li><span>Colgate</span></li>
    <li><span>Columbia</span></li>
    <li><span>Cooper Union</span></li>
    <li><span>Cornell</span></li>
    <li><span>Curtin</span></li>
    <li><span>Dartmouth</span></li>
    <li><span>Davidson</span></li>
    <li><span>Delft</span></li>
  	<li><span>Deloitte University Press</span></li>
    <li><span>EPFL</span></li>
    <li><span>ETH</span></li>
    <li><span>Fullbridge</span></li>
    <li><span>Georgetown</span></li>
    <li><span>Hamilton</span></li>
    <li><span>Harvard</span></li>
    <li><span>Harvey Mudd</span></li>
    <li><span>HK Poly</span></li>
    <li><span>HKUST</span></li>
    <li><span>IDB</span></li>
    <li><span>México</span></li>
    <li><span>MIT</span></li>
    <li><span>UC Berkeley</span></li>
    <li><span>UCSF</span></li>
    <li><span>UPValencia</span></li>
    <li><span>UQ</span></li>
    <li><span>UTArlington</span></li>
    <li><span>UTAustin</span></li>
    <li><span>UTPermianBasin</span></li>
    <li><span>UWashington</span></li>
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
