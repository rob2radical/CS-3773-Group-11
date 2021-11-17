<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['reserve'])) 
{ 
    $roomType = $_POST["room_type"]; 
    $checkIn = $_POST["check-in"];
    $checkOut = $_POST["check-out"];

    if(emptyReserve($roomType, $checkIn, $checkOut) !== false) 
    { 
        header("location: ../reserveProp.php?error=emptyinput");
        exit();
    }
    if(invalidDate($checkIn, $checkOut) !== false)
    { 
        header("location: ../reserveProp.php?error=invalidDate");
        exit();
    }

}