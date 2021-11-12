<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["deleteHot"])) {

    $hotelName = $_POST["hotelname"];

    deleteHotel($conn, $hotelName); 
    deleteAmenities($conn, $hotelName);
} 
else {
	header("location: ../modProp.php?error=deleteerror");
    exit();
}

?>