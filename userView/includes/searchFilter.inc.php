<?php

    require_once "dbh.inc.php";
    require_once 'functions.inc.php';

    if (isset($_POST["search"]))
    {
        $pRange = $_POST["sPrice"];
        $fromDate = $_POST["sCheck-in"];
        $toDate = $_POST["sCheck-out"];
        $sAmen = $_POST["sAmenity"];
        $sAvail = $_POST["sAvail"];

        if(invalidNumberFloat($pRange) !== false)
        {
            header("location: ../filteredSearch.php?error=invalidprice");
		    exit();
        }
        ///VALIDATE THE REST OF THIS AND FIGURE OUT DATES TO PRICE CONVERTION
    }
    else
    {
        header("location: ../filteredSearch.php");
        exit();
    }


?>