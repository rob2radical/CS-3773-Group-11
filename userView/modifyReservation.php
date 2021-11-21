<?php
  session_start();
  include_once 'includes/functions.inc.php';
  include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>View Properties - Hotel Miago</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>

    <!--A quick navigation-->
    <nav>
      <div class="wrapper">
        <a href="index.php"><img src="img/Miago Logo.jpg" width="1000px"alt="Miago logo"></a>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="ViewProps.php">View Properties</a></li>
          <?php
            if (isset($_SESSION["useruid"]) && ($_SESSION["isAdmin"] == 0)) {
              echo "<li><a href='profile.php'>Profile Page</a></li>";
              echo "<li><a href='reserve.php'>Make a Reservation</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else if(isset($_SESSION["useruid"]) && ($_SESSION["isAdmin"] == 1))
            {
              echo "<li><a href='adminProfile.php'>Admin Page</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='userSignUp.php'>Sign up</a></li>";
              echo "<li><a href='userLogin.php'>Log in</a></li>";
            }
          ?>
        </ul>
      </div>
    </nav>

<div class="wrapper">
  <section class="signup-form"> 
    <h1>Update Reservation Information</h1> 
    <div class="signup-form-form"> 
      <form action="includes/updateReserve.inc.php" method="post"> 
          <?php 
          if(isset($_POST["reserveStart"])) 
          { 
            $resID = $_POST["resId"];
            //$hotelName = $_POST["hotelName"]; 
          }
          else if(isset($_GET["resId"]))
          {
            $resID = $_GET["resId"];
            //$hotelName = $_GET["hotelName"];
          }
          $sql = "SELECT * FROM hotels JOIN reservations ON hotels.hotelName = reservations.hotelName WHERE resId = ? "; 
          $stmt = mysqli_stmt_init($conn); 
          if(!mysqli_stmt_prepare($stmt, $sql)) { 
            header("location: modifyReservation.php?error=stmtfailed");
            exit(); 
          } 
          mysqli_stmt_bind_param($stmt, "s", $resID); 
          mysqli_stmt_execute($stmt); 
          // "Get result" returns the results from a prepared statement 
          $result = mysqli_stmt_get_result($stmt);
          $row = mysqli_fetch_assoc($result);
          mysqli_stmt_close($stmt);

          //$hotelName = $row["hotelName"];
          echo "<label for=room_type>Select Room Type:</label>";
          echo "<select name=room_type id=room_type>";
          if($row["numRoomS"] != NULL)
          {  
            echo "<option>Standard</option>";
          } 
          if($row["numRoomQ"] != NULL) 
          {  
            echo "<option>Queen</option>";
          } 
          if($row["numRoomK"] != NULL) 
          { 
            echo "<option>King</option>";
          }
          echo "</select>";
          ?>
          <input type="hidden" id="resid" name="resid" value="<?php echo $resID;?>">
          <label for="check-in">Check-In Date:</label>
          <input type="date" id="check-in" name="check-in">
          <label for="check-out">Check-Out Date:</label>
          <input type="date" id="check-out" name="check-out">
          <button type="submit" class="button" name="updateReserve">Update Reservation</button>
          <button type="submit" class="button" name="deleteReserve">Cancel Reservation</button>   
        </form>
          <?php
            if(isset($_GET["error"]))
            {
              if($_GET["error"] == "notAvail")
              {
                echo "<p>The updated date you request is not available.</p>";
              }
            }
          ?>
      </div> 
    </div> 
  </div> 
</div> 
</section>

<?php
  include_once 'footer.php';
?>