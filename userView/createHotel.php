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
      <input type="text" name="queenPrice" placeholder="Price of a Queen Room...">
      <input type="text" name="kingPrice" placeholder="Price of a King Room...">
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
      else if ($_GET["error"] == "invalidhotelname") {
        echo "<p>Invalid Hotel Name!</p>";
      }
      else if ($_GET["error"] == "invalidnumrooms") {
        echo "<p>Must type a number!</p>";
      } 
      else if ($_GET["error"] == "invalidnumroomq") { 
        echo "<p>Must type a number, 0 means N/A!</p>"; 
      }
      else if ($_GET["error"] == "invalidnumroomk") {
        echo "<p>Must type a number, 0 means N/A!</p>";
      }
      else if ($_GET["error"] == "invalidprices") {
        echo "<p>Standard rooms was not a valid number!</p>";
      }
      else if ($_GET["error"] == "invalidpriceq") {
        echo "<p>Queen rooms was not a valid number!</p>";
      }
      else if ($_GET["error"] == "invalidpricek") {
        echo "<p>King rooms was not a valid number!</p>";
      }
      else if ($_GET["error"] == "invalidweekdiff") {
        echo "<p>Weekend Differential was not a fraction!</p>";
      }
      else if ($_GET["error"] == "invalidamenities") {
        echo "<p>Amenities must contain a number, 0 means N/A!</p>";
      }
      else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
      }
      else if ($_GET["error"] == "none") {
        echo "<p>Hotel Created!</p>";
      }
    }
  ?>
</section>

<?php
  include_once 'footer.php';
?>