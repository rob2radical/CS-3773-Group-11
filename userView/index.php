<!--Splitting the header and footer into separate documents makes things easier!-->
<?php
  include_once 'header.php';
?>

<section class="index-intro"> 
  <?php 
    if (isset($_SESSION["useruid"])) { 
      echo "<h1> Hello " . $_SESSION["useruid"] . "!</h1>";
    } 
  ?>
  <div>
    <label for=""></label>
    <input type="button" value="View Properties">
  </div>
</section>

<section class="index-categories">
  <h2>hello</h2>
  <div class="index-categories-list">
    <div> 
      <img src="img/MagnoliaAllsuites.jpg" width="203.03px" height="200px">
    </div>
    <div>
    <img src="img/LoftsAtTownCentre.jpg" width="203.03px" height="200px">
    </div>
    <div>
    <img src="img/ParkNorthHotel.jpg" width="203.03px" height="200px">
    </div>
    <div>
    <img src="img/TownInnBudgetRooms.jpg" width="203.03px" height="200px">
    </div>
  </div>
</section>

<?php
  include_once 'footer.php';
?>
