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
            if (isset($_SESSION["useruid"])) {
              echo "<li><a href='profile.php'>Profile Page</a></li>";
              echo "<li><a href='reserveProp.php'>Make a Reservation</a></li>";
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
<section class="index-categories">
<table>
  <tr>
    <th>Hotel</th>
    <th>Standard Rooms</th>
    <th>Queen Rooms</th>
    <th>King Rooms</th>
    <th>Standard $</th>
    <th>Queen $</th>
    <th>King $</th>
    <th>Pool</th>
    <th>Gym</th>
    <th>Office</th>
    <th>Spa</th>
    <th>Weekend Differential</th>
  </tr>
  <?php
  $sql = "SELECT * FROM hotels";
  $result = $conn->query($sql);

  //. $row["pool"]. "</td></tr>" . $row["gym"]. "</td></tr>" . $row["office"]. "</td></tr>" . $row["spa"]. "</td></tr>" .
  if($result-> num_rows > 0)
  {
    while($row = $result-> fetch_assoc())
    {
      echo "<div><tr><td>" . $row["hotelName"]. "</td><td>" . $row["numRoomS"] . "</td><td>" . $row["numRoomQ"] . "</td><td>". $row["numRoomK"] 
      . "</td><td>". $row["standardPrice"] . "</td><td>" . $row["queenPrice"] . "</td><td>" . $row["kingPrice"] . "</td><td>" . $row["weekendDiff"]. "</td></tr></div>";
    }
    echo "</table>";
  }
  else
  {
    echo "0 results";
  }
  ?>
</section>

<?php
  include_once 'footer.php';
?>