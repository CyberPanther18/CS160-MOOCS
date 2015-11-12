<?php
$TITLE = "ULearn - Browse";
require "./inc/header.php";
?>
<section id="browse" class="main">
<div class="columns" id="browse">
<div class="leftcolumn">
<?php require "./inc/filter.php"; ?>
</div>
<div class="majoritycolumn">
  <?php 
 require "./db/showcourses.php";
 ?>
 </div>


</div>
</section>
<?php
require "./inc/footer.php";
?>