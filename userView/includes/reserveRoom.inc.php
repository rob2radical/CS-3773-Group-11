<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['reserve'])) 
{ 
    $checkIn = $_POST["check-in"];
    $checkOut = $_POST["check-out"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $username = $_POST["uid"];

    if(emptyReserve($checkIn, $checkOut, $name, $email, $phone, $username) !== false) 
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