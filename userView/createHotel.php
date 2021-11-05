<?php
  include_once 'header.php';
?>

<div class="wrapper">

<section class="signup-form">
  <h2>Create Hotel</h2>
  <div class="signup-form-form">
    <form action="includes/createHot.inc.php" method="post">
      <input type="text" name="hotelname" placeholder="Hotel name...">
      <input type="text" name="numRoomS" placeholder="# of Standard Rooms...">
      <input type="text" name="numRoomQ" placeholder="# of Queen Rooms...">
      <input type="text" name="numRoomK" placeholder="# of King Rooms...">
      <input type="text" name="standardPrice" placeholder="Price of a Standard Room...">
      <input type="text" name="queenPrice" placeholder="Price of a Standard Room...">
      <input type="text" name="kingPrice" placeholder="Price of a Standard Room...">
      <input type="text" name="weekendDiff" placeholder="Weekend Differential...">
      <input type="text" name="numAmenities" placeholder="Number of Amenities...">
      <button type="submit" class="button" name="submit">Create</button>
    </form>
  </div>
  <?php
    // Error messages
    if (isset($_GET["error"])) {
      if ($_GET["error"] == "emptyinput") {
        echo "<p>Fill in all fields! 0 is equal to N/A</p>";
      }
      //DO THE REST OF VALIDATION ALL THE WAY TO THE BOTTOM (createHotel.inc.php, functions.inc.php must all be in sync)
      else if ($_GET["error"] == "invaliduid") {
        echo "<p>Choose a proper username!</p>";
      }
      else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
      } 
      else if ($_GET["error"] == "invalidphone") { 
        echo "<p>Enter a valid phone number!</p>"; 

      }
      else if ($_GET["error"] == "passwordsdontmatch") {
        echo "<p>Passwords doesn't match!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      }
      else if ($_GET["error"] == "usernametaken") {
        echo "<p>Username already taken!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>You have signed up!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>