<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["remAmenities"])) {

    $hotelID = $_POST["hotelID"];
    $amenityToRemove = $_POST["amenity"];

    remModAmenity($conn, $hotelID, $amenityToRemove);
} 
else {
	header("location: ../modProp.php?error=remAmenerror");
    exit();
}

?>