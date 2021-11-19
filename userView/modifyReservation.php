<?php
  include_once 'header.php';
?>
<div class="wrapper"> 
  <section class="signup-form"> 
    <h1>Update Reservation Information</h1> 
    <div class="signup-form-form"> 
      <form action="includes/updateReserve.inc.php" method="post"> 
          <?php 
          if(isset($_POST["sessionID"])) 
          { 
            $resID = $_POST["sessionID"];
          }
          else if(isset($_GET["resId"])) 
          { 
            $resID = $_GET["resId"];
          }
          ?> 
          <label for="property">Property:</label>
          <select name="property" id="property">
          <input type="hidden" id="sessionID" name="sessionID">
          <label for="room_type">Room Type:</label>
          <select name="room_type" id="room_type">
          <label for="check-in">Check-In Date:</label>
          <input type="date" id="check-in" name="check-in">
          <label for="check-out">Check-Out Date:</label>
          <input type="date" id="check-out" name="check-out">
          <button type="submit" name="reserve">Update Reservation</button>  
        </form> 
      </div> 
    </div> 
  </div> 
</div> 
</section>

<?php
  include_once 'footer.php';
?>