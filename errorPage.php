<?php
require('functions/genericFunctions.php'); 
require('functions/userFunctions.php'); 

startSession(); 

$errorMessage = $_SESSION['Error_Message'] ?: "Unknown Error";

echo "<h1>$errorMessage</h1>";

?>

