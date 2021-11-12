<?php 
include_once "header.php";
include_once "includes/dbh.inc.php";
$curUser = $_SESSION["userid"];
?>
<div class="wrapper">

<section class="signup-form"> 
  <h1>User Information<h1> 
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

      echo "<h2>" . $username . "</h2>";
      echo "<h2>" . $useremail . "</h2>";
      echo "<h2>" . $usersphone . "</h2>";
      echo "<h2>" . $usersuname . "</h2>";
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
  }
  ?>
</section>
<?php
  include_once 'footer.php';
?>
