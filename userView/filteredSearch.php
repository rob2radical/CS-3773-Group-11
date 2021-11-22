<?php
//Change dates to show up after we submit room avalability to appear. Other 3 are fine
  include_once 'header.php';
  include_once "includes/dbh.inc.php";
  include_once "includes/functions.inc.php";
?>
<div class="wrapper">

    <section class="signup-form">
        <h2>Filtered Search Hotels</h2>
        <div class="signup-form-form">
            <form action="filteredSearch.php" method="post">
                <label for=sAvail>Select Room Type:</label>
                <select name="sAvail" id="sAvail">
                    <option>Standard</option>
                    <option>Queen</option>
                    <option>King</option>
                </select>
                <label for="sCheck-in">Check-In Date:</label>
                <input type="date" id="sCheck-in" name="sCheck-in">
                <label for="sCheck-out">Check-Out Date:</label>
                <input type="date" id="sCheck-out" name="sCheck-out">
                <input type="text" name="sPrice" placeholder="Price per Night">
                <input type="text" name="sAmenity" placeholder="Amenities">
                <button type="submit" class="button" name="search">Filter</button>
            </form>
        </div>
        <?php
        if(isset($_POST["search"]))
        {
            $roomType = $_POST["sAvail"];
            $sqlh = "SELECT * FROM hotels WHERE numRoomS > 0";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sqlh)) {
                 header("location: filteredSearch.php?error=stmtfailed");
                exit();
            }
        
            mysqli_stmt_execute($stmt);
            // "Get result" returns the results from a prepared statement
            $result = mysqli_stmt_get_result($stmt);
            //$row = mysqli_fetch_assoc($result);

            $emptyDates = false;
            $emptyPrice = false;

            if(empty($_POST["sCheck-in"]) && empty($_POST["sCheck-out"]))
            {
                $emptyDates = true;
            }
            else if(empty($_POST["sCheck-in"]) || empty($_POST["sCheck-out"]))
            {
                header("location: filteredSearch.php?error=dateEmpty");
                exit();
            }

            if(empty($_POST["sPrice"]))
            {
                $emptyPrice = true;
            }
            else
            {
                $priceRange = $_POST["sPrice"];
                if(invalidNumberFloat($priceRange))
                {
                    header("location: filteredSearch.php?error=invalidPrice");
                    exit();
                }
            }


            echo "<table>";
            echo "<tr><th>Hotel</th><th>Amenities</th><th>Standard</th><th>Queen</th><th>King</th></tr>";
            while($row = mysqli_fetch_assoc($result))
            {
                $hotelID = $row["hotelId"];
                $hotelName = $row["hotelName"];

                //amenity filter
                if(!empty($_POST["sAmenity"]))
                {
                    $amenity = $_POST["sAmenity"];
                    if(amenityExists($conn, $amenity, $hotelID))
                    {
                        $amenFilter = true;
                    }
                    else
                    {
                        $amenFilter = false;
                    }
                }
                else
                {
                    $amenFilter = true;
                }

                $roomPossible = false;
                if($roomType == "Standard")
                {
                    if($row["numRoomS"] != NULL)
                    {
                        $roomPossible = true;
                        $roomPrice = $row["standardPrice"];
                    }
                }
                else if($roomType == "Queen")
                {
                    if($row["numRoomQ"] != NULL)
                    {
                        $roomPossible = true;
                        $roomPrice = $row["queenPrice"];
                    }
                }
                else if($roomType == "King")
                {
                    if($row["numRoomK"] != NULL)
                    {
                        $roomPossible = true;
                        $roomPrice = $row["kingPrice"];
                    }
                }

                if(!$emptyDates && $roomPossible)
                {
                    $checkIn = $_POST["sCheck-in"];
                    $checkOut = $_POST["sCheck-out"];
        
                    if(checkDateAvailFilter($conn, $hotelID, $roomType, $checkIn, $checkOut))
                    {
                        $dateFilter = true;
                    }
                    else
                    {
                        $dateFilter = false;
                    }
                }
                else
                {
                    $dateFilter = true;
                }

                if(!$emptyPrice)
                {
                    if($roomPrice <= $priceRange)
                    {
                        $priceFilter = true;
                    }
                    else
                    {
                        $priceFilter = false;
                    }
                }
                else
                {
                    $priceFilter = true;
                }

                echo "<tr>";
                if($amenFilter && $roomPossible && $dateFilter && $priceFilter)
                {
                    echo "<td>$hotelName</td>";

                    //AMENITIES echo
                    $amenityString = "-";
                    $sqlA = "SELECT * FROM amenities WHERE hotelId = ?";
                    $stmtA = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmtA, $sqlA)) {
                        header("location: filteredSearch.php?error=stmtfailed");
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
                        echo "<td>$amenityString -</td>";
                    }
                    else
                    {
                        echo "<td>No Amenities</td>";
                    }
                    mysqli_stmt_close($stmtA);

                    if($row["numRoomS"] != NULL)
                    {
                        $sPrice = $row["standardPrice"];
                        echo "<td>$$sPrice</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                    if($row["numRoomQ"] != NULL)
                    {
                        $qPrice = $row["queenPrice"];
                        echo "<td>$$qPrice</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                    if($row["numRoomK"] != NULL)
                    {
                        $kPrice = $row["kingPrice"];
                        echo "<td>$$kPrice</td>";
                    }
                    else
                    {
                        echo "<td></td>";
                    }
                }            
                echo "</tr>";
            }
            mysqli_stmt_close($stmt);
            echo "</table>";
        }

        if(isset($_GET["error"]))
        {
            if($_GET["error"] == "stmtfailed")
            {
                echo "<p>Something went Wrong!</p>";
            }
            else if($_GET["error"] == "dateEmpty")
            {
                echo "<p>You must fill both dates or none!</p>";
            }
            else if($_GET["error"] == "invalidPrice")
            {
                echo "<p>Price entered was not a numerical value!</p>";
            }
            
        }
        //ADD TABLE TO SHOW RESULTS
        ?>
        
    </section>




<?php 


    include_once 'footer.php';
?>