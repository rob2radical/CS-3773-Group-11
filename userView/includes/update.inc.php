<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

$userId = $_POST["sessionID"];
if(isset($_POST["update"])) {

    $email = $_POST["email"]; 
    updateUser($conn, $email, $userId); 
} 

?>