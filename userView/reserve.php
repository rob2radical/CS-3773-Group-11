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
          ?>
        </ul>
      </div>
    </nav>

<!--A quick wrapper to align the content (ends in footer.php)-->
<div class="wrapper">
  <section class="signup-form">
    <form action="userReservations.php" method="post">
      <input type="hidden" id="sessionID" name="sessionID" value="<?php echo $_SESSION["userid"]; ?>">
      <button type="submit" class="button" name="seeReserve">Current Reservations</button>
    </form>
    <table>   
    <tr>
      <th>Choose a Hotel</th>
    </tr> 
        <?php
          $sql = "SELECT * FROM hotels";
          $result = $conn->query($sql);
          $submit = "submit";
          $buttonType = "button";
          $prop = "reserveProp.php";
          $post = "post";
          $hidden = "hidden";
          $sessionId = "sessionID";
        
          if($result-> num_rows > 0)
          {
            while($row = $result-> fetch_assoc())
            {
              echo "<form action=". $prop . " method=". $post . ">";
              echo "<input type=" . $hidden . " id=" . $sessionId ." name=" . $sessionId . " value=" . $row["hotelId"] . ">";
              echo "<tr><td><button type=" . $submit . " name=" . $row["hotelId"] . " class=" . $buttonType . ">" . $row["hotelName"] . "</button></td></tr>";
              echo "</form>";
            }
          }
          else
          {
            echo "0 results";
          }
        ?>
  </table>
</section>