<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST['updateReserve'])) 
{ 
    $resID = $_POST["resId"];

    updateReserve($conn, $resID);
}