<?php
$TITLE = "Home";
require "./inc/header.php";
?>
<section id="home" class="main">
	<div class="leftcolumn"></div>
	<div class="middlecolumn">
		<div id="quote"></div>
	</div>
	<div class="rightcolumn"></div>
</section>
<script>
$(document).ready(function(){	
	function findBackground(){
		$.getJSON("https://www.reddit.com/r/EarthPorn/top.json?limit=20&t=week", 
				function(data) {
					setBackground(data, Math.floor((Math.random() * 5)));
				}
			);
	}
	function setBackground(json, num){
		var img = json.data.children[num].data.preview.images[0].source;
		console.log(JSON.stringify(img));
		if (img.width > img.height){
			$main = $("main");
			$main.css('background-size', 'contain');
			$main.css('background', 'url('+JSON.stringify(json.data.children[num].data.preview.images[0].source.url)+') no-repeat center top fixed');
		} else {
			setBackground(json, num+1);
		}
	}
	findBackground();
});
</script>
<?php
require "./inc/footer.php";
?>