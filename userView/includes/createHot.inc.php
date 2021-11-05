<?php

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
  $hotelname = $_POST["hotelname"];
  $numRoomS = $_POST["numRoomS"];
  $numRoomQ = $_POST["numRoomQ"];
  $numRoomK = $_POST["numRoomK"];
  $standardPrice = $_POST["standardPrice"];
  $queenPrice = $_POST["queenPrice"];
  $kingPrice = $_POST["kingPrice"];
  $weekendDiff = $_POST["weekendDiff"];
  $numAmenities = $_POST["numAmenities"];

  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php

  require_once "dbh.inc.php";
  require_once 'functions.inc.php';

  // Left inputs empty
  // We set the functions "!== false" since "=== true" has a risk of giving us the wrong outcome
  if (emptyInputHotel($hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff, $numAmenities) !== false) {
    header("location: ../createHotel.php?error=emptyinput");
		exit();
  }
	// Proper username chosen
  if (invalidUid($uid) !== false) {
    header("location: ../userSignUp.php?error=invaliduid");
		exit();
  }
  // Proper email chosen
  if (invalidEmail($email) !== false) {
    header("location: ../userSignUp.php?error=invalidemail");
		exit();
  } 
  // Valid phone number entered
  if (invalidPhone($phone) !== false) { 
    header("location: ../userSignUp.php?error=invalidphone");
    exit();
  }
  // Do the two passwords match?
  if (pwdMatch($pwd, $pwdRepeat) !== false) {
    header("location: ../userSignUp.php?error=passwordsdontmatch");
		exit();
  }
  // Is the username taken already
  if (uidExists($conn, $username) !== false) {
    header("location: ../userSignUp.php?error=usernametaken");
		exit();
  }

  // If we get to here, it means there are no user errors

  // Now we insert the user into the database
  createUser($conn, $name, $email, $phone, $username, $pwd);

} else {
	header("location: ../userSignUp.php");
    exit();
}