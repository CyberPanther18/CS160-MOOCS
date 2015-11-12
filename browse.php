<?php
$TITLE = "Browse";
require "./inc/header.php";
?>
<section id="browse" class="main">
	<div class="columns" id="browse">
		<div class="leftcolumn">
<?php require "./inc/filter.php"; ?>
<script type="application/javascript">
	$(".refinement li").click(function(){
		$category = $(this).parent().attr('id');
		$value = $(this).children("span").text();
		console.log($value);
	});
	$("#filter .seeMore, #filter .seeLess").click(function(){
		$ul = $(this).attr('id').substring(4);
		$("#"+$ul).toggle();
	});
</script>
</div>
		<div class="majoritycolumn">
  <?php
		$type = "browse";
		require "./db/showcourses.php";
		?>
		<script type='application/javascript'
				src='./plugins/datatables/dataTables.min.js'></script>
			<script type='application/javascript'>
			$(document).ready(function(){
    			$('#courses').DataTable();
    		});
    	</script>
		</div>
	</div>
</section>
<?php
require "./inc/footer.php";
?>