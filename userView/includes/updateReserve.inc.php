<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['updateReserve'])) 
{ 
    echo "bouta update BITCH";
    $resID = $_POST["resId"];
    $roomType = $_POST["room_type"];
    $checkIn = $_POST["check-in"];
    $checkOut = $_POST["check-out"];

    if(emptyReserve($roomType, $checkIn, $checkOut) !== false) 
    { 
        header("location: ../reserveProp.php?error=emptyinput&hotelID=$hotelID&id=$usersID");
        exit();
    }
    if(invalidDate($checkIn, $checkOut) !== false)
    { 
        header("location: ../reserveProp.php?error=invalidDate&hotelID=$hotelID&id=$usersID");
        exit();
    } 
    if(!hotelExists($conn, $hotelName) !== false) 
    { 
        header("location: ../reserveProp.php?error=hotelExists&hotelID=$hotelID&id=$usersID");
    }

    updateReserve($conn, $resID, $roomType, $checkIn, $checkOut);
}