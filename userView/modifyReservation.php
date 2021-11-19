<?php
  include_once 'header.php';
?>
<div class="wrapper"> 
  <section class="signup-form"> 
    <h1>Update Reservation Information</h1> 
    <div class="signup-form-form"> 
      <form action="includes/updateReserve.inc.php" method="post"> 
        <div> 
          <?php 
          if(isset($_POST["sessionID"])) 
          { 
            $resID = $_POST["sessionID"];
          }
          else if(isset($_GET["resId"])) 
          { 
            $resID = $_GET["resId"];
          }
          ?>
        </div>
    </div> 

</div> 
</section>

<?php
  include_once 'footer.php';
?>