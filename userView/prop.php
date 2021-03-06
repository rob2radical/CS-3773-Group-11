<?php
    
    include_once 'header.php';
    include_once "includes/dbh.inc.php";
?>


<div class="wrapper">

    <section class="signup-form">
        <?php
        if(isset($_POST["sessionID"]))
        {
            $hotelID = $_POST["sessionID"];

            $sql = "SELECT * FROM hotels WHERE hotelId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                 header("location: prop.php?error=stmtfailed");
                exit();
            }
        
            mysqli_stmt_bind_param($stmt, "s", $hotelID);
            mysqli_stmt_execute($stmt);
            // "Get result" returns the results from a prepared statement
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_assoc($result);
            mysqli_stmt_close($stmt);

            $hotelname = $row["hotelName"];
            //We assume that every property has atleast a Standard Room. King and Queen are optional
            $roomTypes = "Standard";
            $roomPrices = $row["standardPrice"];
            $weekendSPrice = $row["standardPrice"] + ($row["standardPrice"] * $row["weekendDiff"]);
            $weekendString = $weekendSPrice;
            
            if($row["numRoomQ"] != NULL)
            {
                $roomTypes = $roomTypes . " - Queen";
                $roomPrices = $roomPrices . " - " . $row["queenPrice"];
                $weekendQPrice = $row["queenPrice"] + ($row["queenPrice"] * $row["weekendDiff"]);
                $weekendString = $weekendString . " - " . $weekendQPrice;
            }
            if($row["numRoomK"] != NULL)
            {
                $roomTypes = $roomTypes . " - King";
                $roomPrices = $roomPrices . " - " . $row["kingPrice"];
                $weekendKPrice = $row["kingPrice"] + ($row["kingPrice"] * $row["weekendDiff"]);
                $weekendString = $weekendString . " - " . $weekendKPrice;
            }
            echo "<h2>";
            echo "<u>Hotel Name</u> - $hotelname<br><br>";
            echo "<u>Room Types</u> - $roomTypes<br><br>";
            echo "<u>Room Prices</u> - $roomPrices<br><br>";
            echo "<u>Weekend Prices</u> - $weekendString<br><br>";
            echo "</h2>";

            $sqlA = "SELECT * FROM amenities WHERE hotelId = ?";
            $stmtA = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtA, $sqlA)) {
                 header("location: prop.php?error=stmtfailed");
                exit();
            }
        
            mysqli_stmt_bind_param($stmtA, "s", $hotelID);
            mysqli_stmt_execute($stmtA);
            // "Get result" returns the results from a prepared statement
            $resultA = mysqli_stmt_get_result($stmtA);
            
            $amenityString = "";
            if($resultA-> num_rows > 0)
            {
                while($rowA = mysqli_fetch_assoc($resultA))
                {
                    $amenityString = $amenityString . " - " . $rowA["amenity"];
                }
                echo "<h2><u>Amenities</u>$amenityString</h2><br>";
            }
            else
            {
                echo "<h2> No Amenities </h2>";
            }

            mysqli_stmt_close($stmtA);
        }  
        
        if(isset($_GET["error"]))
        {
            if($_GET["error"] == "stmtfailed") {
                echo "<p>Something went wrong!</p>";
            }
        }
        ?>
    </section>
</div>
<?php
    include_once 'footer.php';
?>