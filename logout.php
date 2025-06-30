<?php 
require('functions/userFunctions.php'); 
require('functions/genericFunctions.php'); 
require('functions/databaseFunctions.php'); 

startSession();
logUserOut();
$_SESSION['status'] = "Logged out successfully";
redirectTo("index.php");
?>