<?php

require_once "dbh.inc.php";
require_once 'functions.inc.php';

if (isset($_POST["submit"])) {

  // First we get the form data from the URL
    $hotelID = $_POST["hotel"];
    $numAmen = $_POST["numAmen"];
    $i = 0;

    $sql = "INSERT INTO amenities (hotelId, amenity) VALUES (?, ?);";
    $stmt = mysqli_stmt_init($conn);

    for($i = 0; $i < intval($numAmen); $i = $i +1)
    {
        $amenity = "Amenity" . $i;
        if(isset($_POST["$amenity"]))
        {
            $amenValue = $_POST["$amenity"];
            echo $amenValue;
            if(!amenityExists($conn, $amenValue, $hotelID))
            {
                //createAmenity($conn, $hotelID, $hotelname, $amenValue);

                if (!mysqli_stmt_prepare($stmt, $sql)) {
                     header("location: ../createHotel.php?error=stmtfailed");
                    exit();
                }
            
                mysqli_stmt_bind_param($stmt, "ss", $hotelID, $amenValue);
                mysqli_stmt_execute($stmt);
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    header("location: ../createHotel.php?error=none");
    exit();
} else {
	header("location: ../createHotel.php");
    exit();
}



  // Then we run a bunch of error handlers to catch any user mistakes we can (you can add more than I did)
  // These functions can be found in functions.inc.php
