<?php 
include_once "header.php";
include_once "includes/dbh.inc.php";
//$curUser = $_SESSION["userid"];
?>
<div class="wrapper">

<section class="signup-form"> 
  <h1>Hotel Information<h1> 
  <?php
        if(isset($_POST["hotelID"]))
        {
            $hotelID = $_POST["hotelID"];
            $hotelname = showHotelInfo($conn, $hotelID);
        }
        else if(isset($_GET["id"]))
        {
            $hotelID = $_GET["id"];
            $hotelname = showHotelInfo($conn, $hotelID);
        }
        else
        {
            echo "<h2>NOT SET</h2>";
        }
    ?>
  <h2>Update Hotel Information</h2>
  <div class="signup-form-form">
    <form action="includes/updateHotel.inc.php" method="post">
      <input type="hidden" id="hotelname" name="hotelname" value="<?php echo $hotelname; ?>">
      <input type="hidden" id="hotelID" name="hotelID" value="<?php echo $hotelID; ?>">
      <input type="text" name="hName" placeholder="Hotel Name">
      <input type="text" name="hnumRoomS" placeholder="# of Standard Rooms">
      <input type="text" name="hnumRoomQ" placeholder="# of Queen Rooms">
      <input type="text" name="hnumRoomK" placeholder="# of King Rooms">
      <input type="text" name="hstandardPrice" placeholder="$ of Standard Room">
      <input type="text" name="hqueenPrice" placeholder="$ of Queen Room">
      <input type="text" name="hkingPrice" placeholder="$ of King Room">
      <input type="text" name="hweekendDiff" placeholder="Weekend Differential">
      <button type="submit" class="button" name="updateHot">Update</button>
    </form>
    <form action="includes/deleteHotel.inc.php" method="post">
        <input type="hidden" id="hotelname" name="hotelname" value="<?php echo $hotelname; ?>">
        <button type="submit" class="button" name="deleteHot">Delete</button>
    </form>
  </div> 
  <?php 
  if(isset($_GET["error"])) 
  { 
    if($_GET["error"] == "none") { 
        echo "<p>Your Information has been updated!</p>"; 
    } 
    else if($_GET["error"] == "updaterror") { 
        echo "<p>An error occurred when attempting to update hotel information</p>"; 
    }
    else if($_GET["error"] == "deleteerror") {
        echo "<p>An error occurred when attempting to delete hotel information</p>"; 
    }
    else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong!</p>";
    }
    else if ($_GET["error"] == "invalidnumrooms") {
        echo "<p>Must type a number!</p>";
    } 
    else if ($_GET["error"] == "invalidnumroomq") { 
        echo "<p>Must type a number, 0 means N/A!</p>"; 
    }
    else if ($_GET["error"] == "invalidnumroomk") {
        echo "<p>Must type a number, 0 means N/A!</p>";
    }
    else if ($_GET["error"] == "invalidprices") {
        echo "<p>Standard rooms was not a valid numeric price!</p>";
    }
    else if ($_GET["error"] == "invalidpriceq") {
        echo "<p>Queen rooms was not a valid numeric price!</p>";
    }
    else if ($_GET["error"] == "invalidpricek") {
        echo "<p>King rooms was not a valid numeric price!</p>";
    }
    else if ($_GET["error"] == "invalidweekdiff") {
        echo "<p>Weekend Differential was not a proper multiplier!</p>";
    }
    else if ($_GET["error"] == "hotelexists") {
        echo "<p>New Hotel Name already exists!</p>";
    }
  }
  ?>
</section>
<?php
    function showHotelInfo($conn, $hotelID){
        
            $sql = "SELECT * FROM hotels WHERE hotelId = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("location: modProp.php?error=stmtfailed");
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
            
            if($row["numRoomQ"] != NULL && $row["queenPrice"] != NULL)
            {
                $roomTypes = $roomTypes . " - Queen";
                $roomPrices = $roomPrices . " - " . $row["queenPrice"];
                $weekendQPrice = $row["queenPrice"] + ($row["queenPrice"] * $row["weekendDiff"]);
                $weekendString = $weekendString . " - " . $weekendQPrice;
            }
            if($row["numRoomK"] != NULL && $row["kingPrice"] != NULL)
            {
                $roomTypes = $roomTypes . " - King";
                $roomPrices = $roomPrices . " - " . $row["kingPrice"];
                $weekendKPrice = $row["kingPrice"] + ($row["kingPrice"] * $row["weekendDiff"]);
                $weekendString = $weekendString . " - " . $weekendKPrice;
            }

            
            
            echo "<h2>" . $hotelname . "</h2>";
            echo "<h2>" . $roomTypes . "</h2>";
            echo "<h2>" . $roomPrices . "</h2>";
            echo "<h2>" . $weekendString . "</h2>";

            $sqlA = "SELECT * FROM amenities WHERE hotelId = ?";
            $stmtA = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmtA, $sqlA)) {
                 header("location: modProp.php?error=stmtfailed");
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
                echo "<h2>" . $amenityString . " - </h2>";
            }
            else
            {
                echo "<h2> No Amenities </h2>";
            }
            return $hotelname;
           mysqli_stmt_close($stmtA);
    }
  include_once 'footer.php';
?>

