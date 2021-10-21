<?php 
include_once "header.php"; 
$curUser = $_SESSION["useruid"];

echo "<section class=\"index-intro\">"; 
echo "<h1>Welcome $curUser!</h1>";
echo "</section>";