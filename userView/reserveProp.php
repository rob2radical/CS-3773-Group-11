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
    <!--I won't do more than barebone HTML, since this isn't an HTML tutorial.-->
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
              //echo "<li><a href='reserveProp.php'>Reservations</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='userSignUp.php'>Sign up</a></li>";
              echo "<li><a href='userLogin.php'>Log in</a></li>";
            }
/*             if (isset($_SESSION["useruid"])) {
              echo "<li><a href='profile.php'>Profile Page</a></li>";
              echo "<li><a href='reserveProp.php'>Make a Reservation</a></li>";
              echo "<li><a href='logout.php'>Logout</a></li>";
            }
            else {
              echo "<li><a href='userSignUp.php'>Sign up</a></li>";
              echo "<li><a href='userLogin.php'>Log in</a></li>";
            } */
          ?>
        </ul>
      </div>
    </nav>

<div class="wrapper">
  <section class="signup-form"> 
      <h1>Reservation Information</h2> 
      <div class="signup-form-form"> 
        <form action="includes/reserveRoom.inc.php" method="post">
            <div>
                <?php 
                if(isset($_POST["sessionID"]))
                { 
                  $hotelID = $_POST["sessionID"];
                  #echo "$hotelID"; 
                  $query = "SELECT * from hotels WHERE hotelId = ?";
                  
                  $stmt = mysqli_stmt_init($conn);
                  if (!mysqli_stmt_prepare($stmt, $query)) { 
                      header("location: reserveProp.php?error=stmtfailed");
                      exit();
                  } 

                  mysqli_stmt_bind_param($stmt, "s", $hotelID);
                  mysqli_stmt_execute($stmt);
                  // "Get result" returns the results from a prepared statement
                  $result = mysqli_stmt_get_result($stmt);
                  $row = mysqli_fetch_assoc($result);
                  mysqli_stmt_close($stmt);
             
                  if($row["numRoomS"] == 0 && $row["numRoomS"] == 0 && $row["numRoomS"] == 0) 
                  { 
                    echo "No rooms available";
                    exit();

                  }
                  else 
                  { 
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
                  }
                  echo "</select>";
                } 
                ?>
            </div> 
            <label for="check-in">Check-In Date:</label>
            <input type="date" id="check-in" name="check-in">
            <label for="check-out">Check-Out Date:</label>
            <input type="date" id="check-out" name="check-out">
            <button type="submit" name="reserve">Reserve</button> 
        </form>
      </div>
        <?php 
        //echo "<div>" . $_SESSION["userid"] . "</div>";
        if(isset($_GET["error"])) 
        { 
            if($_GET["error"] == "emptyinput") 
            { 
                echo "<p>Fill in all fields!</p>";
            } 
            else if($_GET["error"] == "invalidDate") 
            { 
                echo "<p>Invalid Check-In/Out Date!</p>";
            } 
            else if($_GET["error"] == "stmtfailed") 
            { 
              echo "<p>Could not fetch hotel information";
            }
        } 
       ?>
       </section>

       <?php 
         include_once 'footer.php';
       ?>