<?php
$TITLE = "Table";
require "./inc/header.php";
?>
<section id="table" class="main">
	<div>
  <?php
		$type = "all";
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