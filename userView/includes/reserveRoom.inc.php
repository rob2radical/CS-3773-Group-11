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
    $weekendDiff = $_POST["weekDiff"];


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
else if(isset($_POST['quote']))
{
    $hotelID = $_POST["hotelID"];
    $usersID = $_POST["usersId"];
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

    $price = getPrice($conn, $hotelID, $usersID, $roomType, $checkIn, $checkOut);
    header("location: ../reserveProp.php?error=none&hotelID=$hotelID&id=$usersID&qPrice=$price");
	exit();
}