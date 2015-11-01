<?php
$TITLE = "ULearn - Browse";
require "./inc/header.php";
?>
<section id="browse">
<div class="columns" id="browse">
<div class="leftcolumn">
<?php require "./inc/filter.php"; ?>
</div>
<div class="middlecolumn">
  <?php require "./db/showCourses.php"; ?>
</div>
</section>
<?php
require "./db/disconnect.php";
require "./inc/footer.php";
?>
