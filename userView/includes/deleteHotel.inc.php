<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["deleteHot"])) {

    $hotelName = $_POST["hotelname"];

    deleteAllAmenities($conn, $hotelName);
    deleteHotel($conn, $hotelName); 
} 
else {
	header("location: ../modProp.php?error=deleteerror");
    exit();
}

?>