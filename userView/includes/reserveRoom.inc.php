<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['reserve'])) 
{ 
    $hotelID = $_POST["hotelID"];
    $usersID = $_POST["usersId"];
    $hotelName = $_POST["hotelName"];
    $roomType = $_POST["room_type"];
    $uName = $_POST["userName"];
    $phone = $_POST["usersPhone"];
    $email = $_POST["usersEmail"];
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

    createReserve($conn, $hotelID, $usersID, $hotelName, $roomType, $uName, $phone, $email, $checkIn, $checkOut);



}