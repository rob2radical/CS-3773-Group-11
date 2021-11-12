<?php 
include_once "header.php";
include_once "includes/dbh.inc.php";
$curUser = $_SESSION["userid"];
?>
<div class="wrapper">

<section class="signup-form"> 
  <h1><u>User Information<h1></u>
  <br>
    <?php
    if(isset($_SESSION["userid"])) 
    { 
      $userID = $_SESSION["userid"]; 

      $sql = "SELECT * from users WHERE usersId = ? ";
      $stmt = mysqli_stmt_init($conn);
      if (!mysqli_stmt_prepare($stmt, $sql)) {
           header("location: prop.php?error=stmtfailed");
          exit();
      } 
      mysqli_stmt_bind_param($stmt, "s", $userID); 
      mysqli_stmt_execute($stmt); 
      // "Get result" returns the results from a prepared statement
      $result = mysqli_stmt_get_result($stmt);
      $row = mysqli_fetch_assoc($result);
      mysqli_stmt_close($stmt);

      $username = $row["usersName"];
      $useremail = $row["usersEmail"];
      $usersphone = $row["usersPhone"];
      $usersuname = $row["usersUid"];
      $userRole = $row["isAdmin"];

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
  <h2>Update Information</h2>
  <div class="signup-form-form">
    <form action="includes/update.inc.php" method="post">
      <input type="hidden" id="sessionID" name="sessionID" value="<?php echo $curUser; ?>">
      <input type="hidden" id="isAdmin" name="isAdmin" value="<?php echo $userRole; ?>">
      <input type="text" name="name" placeholder="Full name...">
      <input type="text" name="email" placeholder="Email...">
      <input type="text" name="phone" placeholder="Phone Number...">
      <input type="text" name="uid" placeholder="Username...">
      <button type="submit" class="button" name="update">Update Information</button>
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
    else if($_GET["error"] == "invaliduid") 
    { 
      echo "<p>An invalid username was entered</p>"; 
    }
    else if($_GET["error"] == "invalidemail") 
    { 
      echo "<p>An invalid email was entered</p>"; 
    }
    else if($_GET["error"] == "invalidphone") 
    { 
      echo "<p>An invalid phone number was entered</p>";
    } 
    else if ($_GET["error"] == "uidExistserror") 
    { 
      echo "<p>That username is already taken!";
    }
    else if ($_GET["error"] == "phoneExistserror") 
    { 
      echo "<p>That phone number is already taken!";
    }
    else if ($_GET["error"] == "emailExistserror") 
    { 
      echo "<p>That email is already taken!";
    }
  }
  ?>
</section>
<?php
  include_once 'footer.php';
?>
