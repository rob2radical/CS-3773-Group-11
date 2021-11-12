<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

$userId = $_POST["sessionID"];
$userRole = $_POST["isAdmin"];
if(isset($_POST["update"])) {

    $name = $_POST["name"]; 
    $email = $_POST["email"]; 
    $phone = $_POST["phone"]; 
    $uid = $_POST["uid"]; 

    updateUser($conn, $name, $email, $phone, $uid, $userId, $userRole);
} 
else {
    if($userRole == 1)
    {
        header("location: ../adminProfile.php?error=updateerror");
        exit();
    }
    else
    {
        header("location: ../profile.php?error=updateerror");
        exit();
    }
}

?>