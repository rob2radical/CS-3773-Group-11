<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["updateHot"])) {

    $hotelname = $_POST["hotelname"];
    $hotelID = $_POST["hotelID"];
    $newHName = $_POST["hName"]; 
    $hnumRoomS = $_POST["hnumRoomS"]; 
    $hnumRoomQ = $_POST["hnumRoomQ"]; 
    $hnumRoomK = $_POST["hnumRoomK"]; 
    $hstandardPrice = $_POST["hstandardPrice"];
    $hqueenPrice = $_POST["hqueenPrice"];
    $hkingPrice = $_POST["hkingPrice"];
    $hweekendDiff = $_POST["hweekendDiff"];

    if (invalidHotelName($newHName) !== false) {
        header("location: ../modProp.php?error=hotelname&id=$hotelID");
        exit();
    }
    if (hotelExists($conn, $newHName) !== false) {
        header("location: ../modProp.php?error=hotelexists&id=$hotelID");
            exit();
    }
    if (invalidNumberIntS($hnumRoomS) !== false) {
        header("location: ../modProp.php?error=invalidnumrooms&id=$hotelID");
        exit();
    }
    if (invalidNumberInt($hnumRoomQ) !== false) {
        header("location: ../modProp.php?error=invalidnumroomq&id=$hotelID");
        exit();
    }
    if (invalidNumberInt($hnumRoomK) !== false) {
        header("location: ../modProp.php?error=invalidnumroomk&id=$hotelID");
        exit();
    }
    if (invalidNumberFloat($hstandardPrice) !== false) {
        header("location: ../modProp.php?error=invalidprices&id=$hotelID");
        exit();
    }
    if (invalidNumberFloat($hqueenPrice) !== false) {
        header("location: ../modProp.php?error=invalidpriceq&id=$hotelID");
        exit();
    }
    if (invalidNumberFloat($hkingPrice) !== false) {
        header("location: ../modProp.php?error=invalidpricek&id=$hotelID");
        exit();
    }
    if (invalidNumberFloat($hweekendDiff) !== false) {
        header("location: ../modProp.php?error=invalidweekdiff&id=$hotelID");
        exit();
    }
    updateHotel($conn, $hotelID, $newHName, $hnumRoomS, $hnumRoomQ, $hnumRoomK, $hstandardPrice, $hqueenPrice, $hkingPrice, $hweekendDiff);
} 
else {
	header("location: ../modProp.php?error=updateerror");
    exit();
}

?>