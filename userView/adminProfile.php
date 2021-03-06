<?php 
include_once "header.php";
include_once "includes/dbh.inc.php";
$curUser = $_SESSION["userid"]; 
?>
<div class="wrapper">

<section class="signup-form"> 
  <h1> Admin User Information<h1> 
    <?php 
    if(isset($_SESSION["userid"])) 
    { 
      $userID = $_SESSION["userid"];

      $sql = "SELECT * from users WHERE usersId = ? ";
      $stmt = mysqli_stmt_init($conn);
      if(!mysqli_stmt_prepare($stmt, $sql)) { 
        header("location: adminProfile.php?error=stmtfailed");
        exit();
      }
      mysqli_stmt_bind_param($stmt, "s", $userID);
      mysqli_stmt_execute($stmt);
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      mysqli_stmt_close($stmt);

      $username = $row["usersName"];
      $useremail = $row["usersEmail"];
      $usersphone = $row["usersPhone"];
      $usersuname = $row["usersUid"];
      $userRole = $row["isAdmin"];

      /* echo "<h2>" . $username . "</h2>";
      echo "<h2>" . $useremail . "</h2>";
      echo "<h2>" . $usersphone . "</h2>";
      echo "<h2>" . $usersuname . "</h2>"; */

      echo "<u>Full Name</u> - $username<br>";
      echo "<br>";
      echo "<u>Email</u> - $useremail<br>";
      echo "<br>";
      echo "<u>Phone Number</u> - $usersphone<br>";
      echo "<br>";
      echo "<u>Username</u> - $usersuname<br>";
      echo "<br>";
    }
    ?>
  <h2>Update Account</h2>
  <div class="signup-form-form">
    <form action="includes/update.inc.php" method="post">
      <input type="hidden" id="sessionID" name="sessionID" value="<?php echo $curUser; ?>">
      <input type="hidden" id="isAdmin" name="isAdmin" value="<?php echo $userRole; ?>">
      <input type="text" name="name" placeholder="Full name...">
      <input type="text" name="email" placeholder="Email...">
      <input type="text" name="phone" placeholder="Phone Number...">
      <input type="text" name="uid" placeholder="Username...">
      <button type="submit" class="button" name="update">Update Account</button>
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
    else if($_GET["error"] == "emailExistserror") 
    { 
      echo "<p>Email address not available.</p>"; 
    }
    else if($_GET["error"] == "phoneExistserror") 
    { 
      echo "<p>Phone number not available.</p>"; 
    }
    else if($_GET["error"] == "uidExistserror") 
    { 
      echo "<p>Username not available.</p>"; 
    }
  }
  ?>
   <h2>Hotels</h2>
  <div class="signup-form-form">
    <!--create hotel button-->
      <form action="createHotel.php" method="post">
        <button type="submit" class="button" name="CreateHot">Create</button>
      </form>

    <!--modify hotel button-->
      <form action="modifyHotel.php" method="post">
        <button type="submit" class="button" name="ModifyHot">Modify</button>
      </form>
  </div>
  <h2>Reservations</h2>
    <div class="signup-form-form">
    <!--create reservation button-->
      <form action="reserve.php" method="post">
        <input type="text" name="uEmail" placeholder="Users Email">
        <button type="submit" class="button" name="CreateRes">Create</button>
      </form>
    <!--modify reservation button-->
      <form action="userReservations.php" method="post">
        <input type="text" name="uEmail" placeholder="Users Email">
        <button type="submit" class="button" name="ModifyRes">Modify</button>
      </form>
    </div>
    <?php 
    if(isset($_GET["error"])) 
    { 
      if($_GET["error"] == "emptyEmail") 
      { 
        echo "<p>Email field was empty!</p>"; 
      }
      else if($_GET["error"] == "uNoExist") 
      { 
        echo "<p>Email entered does not exist in the system!</p>"; 
      }
    }
    ?>
</div>
</section>
<?php
  include_once 'footer.php';
?>