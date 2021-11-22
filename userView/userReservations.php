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
    else if(isset($_POST["uEmail"]))
    {
        if(!empty($_POST["uEmail"]))
        {
            $usersEmail = $_POST["uEmail"];

            $sql = "SELECT * FROM users WHERE usersEmail = ?";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: adminProfile.php?error=stmtfailed");
            exit();
            }
                    
            mysqli_stmt_bind_param($stmt, "s", $usersEmail);
            mysqli_stmt_execute($stmt);
            // "Get result" returns the results from a prepared statement
            $result = mysqli_stmt_get_result($stmt);
            if($result->num_rows > 0)
            {
                $row = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                
                $userID = $row["usersId"];
                showReserves($conn, $userID);
            }
            else
            {
                header("location: adminProfile.php?error=uNoExist");
                exit();
            }
        }
        else
        {
            header("location: adminProfile.php?error=emptyEmail");
            exit();
        }
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
            echo "<tr><td><form action=modifyReservation.php method=post><input type=hidden id=resId name=resId value=" . $row["resId"] . "><button type=submit class=button name=reserveStart>Modify</button></form>" . "</td><td><u>" . $row["hotelName"] . "</u></td><td><u>" . date("M. d", strtotime($row["fromDate"])) . "</u></td><td><u>" . date("M. d", strtotime($row["toDate"])) . "</u></td><td><u>" . $row["roomType"] ."</u></td><td><u>" . $row["totalPrice"] ."</u></td><td>";
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
