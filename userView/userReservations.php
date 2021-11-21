<?php
    
    include_once 'header.php';
    include_once "includes/dbh.inc.php";
?>
<div class="wrapper">

<section class="signup-form">
    <?php
    if(isset($_POST["sessionID"]))
    {
        $userID = $_POST["sessionID"];
        showReserves($conn, $userID);
        
    }
    else if(isset($_GET["userid"]))
    {
        $userID = $_GET["userid"];
        showReserves($conn, $userID);
    }

    if(isset($_GET["error"]))
    {
        if($_GET["error"] == "stmtfailed") {
            echo "<p>Something went wrong!</p>";
        }
        else if($_GET["error"] == "none")
        {
            echo "<p>Reservation Updated!</p>";
        }
    }
    ?>
<?php

function showReserves($conn, $userID)
{
    $sql = "SELECT * FROM reservations WHERE usersId = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: userReservations.php?error=stmtfailed");
        exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $userID);
    mysqli_stmt_execute($stmt);
    // "Get result" returns the results from a prepared statement
    $result = mysqli_stmt_get_result($stmt);
    mysqli_stmt_close($stmt);

    $resString = "";
    echo "<table><tr><th></th><th>Hotel name</th><th>From</th><th>To</th><th>Room Type</th><th>Price</th></tr>";

    if($result-> num_rows > 0)
    { 
        while($row = mysqli_fetch_assoc($result))
        {
            echo "<tr><td><form action=modifyReservation.php method=post><input type=hidden id=hotelName name=hotelName value=" . $row["hotelName"] . "><input type=hidden id=resId name=resId value=" . $row["resId"] . "><button type=submit class=button name=reserveStart>Modify</button></form>" . "</td><td>" . $row["hotelName"] . "</td><td>" . $row["fromDate"] . "</td><td>" . $row["toDate"] . "</td><td>" . $row["roomType"] ."</td><td>" . $row["totalPrice"] ."</td><td>";
        }
    }
    else
    {
        echo "<p>You currently have 0 reservations</p>";
    }
    echo "</table>";
}
    include_once 'footer.php';
?>
