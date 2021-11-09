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
  if (invalidHotelName($hotelname) !== false) {
    header("location: ../createHotel.php?error=invalidhotelname");
		exit();
  }
  if (invalidNumberInt($numRoomS) !== false) {
    header("location: ../createHotel.php?error=invalidnumrooms");
		exit();
  }
  if (invalidNumberInt($numRoomQ) !== false) {
    header("location: ../createHotel.php?error=invalidnumroomq");
		exit();
  } 
  if (invalidNumberInt($numRoomK) !== false) {
    header("location: ../createHotel.php?error=invalidnumroomk");
		exit();
  }  
  if (invalidNumberFloat($standardPrice) !== false) { 
    header("location: ../createHotel.php?error=invalidprices");
    exit();
  }
  if (invalidNumberFloat($queenPrice) !== false) { 
    header("location: ../createHotel.php?error=invalidpriceq");
    exit();
  }  
  if (invalidNumberFloat($kingPrice) !== false) { 
    header("location: ../createHotel.php?error=invalidpricek");
    exit();
  }  
  if (invalidNumberFloat($weekendDiff) !== false) { 
    header("location: ../createHotel.php?error=invalidweekdiff");
    exit();
  }
  if (invalidNumberInt($numAmenities) !== false) {
    header("location: ../createHotel.php?error=invalidamenities");
		exit();
  }  

  // If we get to here, it means there are no hotel errors

  // Now we insert the hotel into the database
  createHotelq($conn, $hotelname, $numRoomS, $numRoomQ, $numRoomK, $standardPrice, $queenPrice, $kingPrice, $weekendDiff);

} else {
	header("location: ../createHotel.php");
    exit();
}