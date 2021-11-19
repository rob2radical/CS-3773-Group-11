<?php
/*$sql = "SELECT * FROM reservations 
WHERE (fromDate >= inputF and toDate <= inputF) or (fromDate < ? and toDate > ? )";*/
  include_once 'header.php';
?>
<div class="wrapper">

    <section class="signup-form">
        <div class="signup-form-form">
            <form action="includes/searchFilter.inc.php" method="post">
                <input type="text" name="sPrice" placeholder="Price Range">
                <label for="check-in">Check-In Date:</label>
                <input type="date" id="sCheck-in" name="sCheck-in">
                <label for="check-out">Check-Out Date:</label>
                <input type="date" id="sCheck-out" name="sCheck-out">
                <input type="text" name="sAmenity" placeholder="Amenities">
                <input type="text" name="sAvail" placeholder="Room Availability">
                <button type="submit" class="button" name="search">Filter</button>
            </form>
        </div>
        <?php
        if(isset($_POST["submit"]))
        {
            //echo $_SESSION["userid"];
        }
        //ADD TABLE TO SHOW RESULTS
        ?>
        
    </section>




<?php 
    include_once 'footer.php';
?>