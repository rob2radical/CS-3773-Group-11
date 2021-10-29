<?php 
include_once "header.php";
include_once "includes/dbh.inc.php";
$curUser = $_SESSION["userid"]; 
?>
<div class="wrapper">

<section class="signup-form">
  <h2>Update Information</h2>
  <div class="signup-form-form">
    <form action="includes/update.inc.php" method="post">
      <input type="hidden" id="sessionID" name="sessionID" value="<?php echo $curUser; ?>">
      <input type="text" name="name" placeholder="Full name...">
      <input type="text" name="email" placeholder="Email...">
      <input type="text" name="phone" placeholder="Phone Number...">
      <input type="text" name="uid" placeholder="Username...">
      <button type="submit" name="update">Update Information</button>
    </form>
  </div> 
  <?php 
  if(isset($_GET["error"])) 
  { 
    if($_GET["error"] == "none") 
    { 
      echo "<p>Your Information has been updated!</p>"; 
    } 
    else if($_GET["error"] == "updaterror") 
    { 
      echo "<p>An error occurred when attempting to update your information</p>"; 
    }
  }
  ?>
</section>
<?php
  include_once 'footer.php';
?>
