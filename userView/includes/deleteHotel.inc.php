<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["deleteHot"])) {

    $hotelID = $_POST["hotelID"];

    deleteHotel($conn, $hotelID); 
    deleteAmenities($conn, $hotelID);
} 
else {
	header("location: ../modProp.php?error=deleteerror");
    exit();
}

?>