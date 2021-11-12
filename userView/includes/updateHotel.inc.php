<?php 
require_once "dbh.inc.php";
require_once "functions.inc.php";

if(isset($_POST["updateHot"])) {

    $hotelname = $_POST["hotelname"];
    $newHName = $_POST["hName"]; 
    $hnumRoomS = $_POST["hnumRoomS"]; 
    $hnumRoomQ = $_POST["hnumRoomQ"]; 
    $hnumRoomK = $_POST["hnumRoomK"]; 
    $hstandardPrice = $_POST["hstandardPrice"];
    $hqueenPrice = $_POST["hqueenPrice"];
    $hkingPrice = $_POST["hkingPrice"];
    $hweekendDiff = $_POST["hweekendDiff"];

    if (invalidHotelName($newHName) !== false) {
        header("location: ../modProp.php?error=hotelname");
        exit();
    }
    if (hotelExists($conn, $newHName) !== false) {
        header("location: ../modProp.php?error=hotelexists");
            exit();
    }
    if (invalidNumberInt($hnumRoomS) !== false) {
        header("location: ../modProp.php?error=invalidnumrooms");
        exit();
    }
    if (invalidNumberInt($hnumRoomQ) !== false) {
        header("location: ../modProp.php?error=invalidnumroomq");
        exit();
    }
    if (invalidNumberInt($hnumRoomK) !== false) {
        header("location: ../modProp.php?error=invalidnumroomk");
        exit();
    }
    if (invalidNumberFloat($hstandardPrice) !== false) {
        header("location: ../modProp.php?error=invalidprices");
        exit();
    }
    if (invalidNumberFloat($hqueenPrice) !== false) {
        header("location: ../modProp.php?error=invalidpriceq");
        exit();
    }
    if (invalidNumberFloat($hkingPrice) !== false) {
        header("location: ../modProp.php?error=invalidpricek");
        exit();
    }
    if (invalidNumberFloat($hweekendDiff) !== false) {
        header("location: ../modProp.php?error=invalidweekdiff");
        exit();
    }
    updateHotel($conn, $hotelname, $newHName, $hnumRoomS, $hnumRoomQ, $hnumRoomK, $hstandardPrice, $hqueenPrice, $hkingPrice, $hweekendDiff);
    updateAmenitiesForHotel($conn, $hotelname, $newHName); 
} 
else {
	header("location: ../modProp.php?error=updateerror");
    exit();
}

?>