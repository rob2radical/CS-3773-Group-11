<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["updateReserve"])) 
{ 
    echo "bouta update BITCH";
    $resID = $_POST["resId"];
    $roomType = $_POST["room_type"];
    $checkIn = $_POST["check-in"];
    $checkOut = $_POST["check-out"];

    updateReserve($conn, $resID, $roomType, $checkIn, $checkOut);
}