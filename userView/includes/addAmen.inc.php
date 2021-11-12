<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["addAmenities"])) {

    $hotelID = $_POST["hotelID"];
    $amenityToAdd = $_POST["amenity"];

    addModAmenity($conn, $hotelID, $amenityToAdd);
} 
else {
	header("location: ../modProp.php?error=addAmenerror");
    exit();
}

?>