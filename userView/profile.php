<?php
  include_once 'header.php';
  $curUser = $_SESSION["useruid"];
?>

/* Test curUser once database is set up */
<html>
<section class="profile-page">
    <h2> Profile for <?php echo $curUser ?></h2> 
    <div class="profile-options">
        
    </div>
</section>
</html>

<?php
  include_once 'footer.php';
?>

