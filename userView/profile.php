<<<<<<< HEAD
<?php 
include_once "header.php"; 
$curUser = $_SESSION["useruid"];

echo "<section class=\"index-intro\">";
echo "</section>";
=======
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
</section>
<?php 

?>

<?php
  include_once 'footer.php';
?>
>>>>>>> b0e3a92ccb686c6f992f983982d145f5356ad372
