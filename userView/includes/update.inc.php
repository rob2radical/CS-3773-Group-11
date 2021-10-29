<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

$userId = $_POST["sessionID"];
if(isset($_POST["update"])) {

    $name = $_POST["name"]; 
    $email = $_POST["email"]; 
    $phone = $_POST["phone"]; 
    $uid = $_POST["uid"]; 

    updateUser($conn, $name, $email, $phone, $uid, $userId); 
} 
else {
	header("location: ../profile.php");
    exit();
}

?>