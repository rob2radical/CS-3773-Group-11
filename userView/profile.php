<?php 
include_once "header.php";
$curUser = $_SESSION["useruid"]; 
echo "<h2>Profile for $curUser</h2>";
include_once 'footer.php';