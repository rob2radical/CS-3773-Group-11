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
            echo $hotelID;

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
            
            
            echo "<h2>" . $hotelname . "</h2>";
            
        }
        ?>
    </section>
</div>
<?php
    include_once 'footer.php';
?>