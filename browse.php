<?php
$TITLE = "ULearn - Browse";
require "./db/connect.php";
?>
<section>
<aside class="leftcolumn">
<?php require "./inc/filter.php"; ?>
</aside>
<section class="middlecolumn">
  <?php require "./db/showCourses.php"; ?>
</section>
</section>
<?php
require "./db/disconnect.php";
?>
