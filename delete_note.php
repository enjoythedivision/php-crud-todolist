<?php
require('functions/userFunctions.php');
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
require('functions/config.php');

session_start();
access();

$welcome_message = "Hi, " . $_SESSION['loggedUserName'];

if (isset($_GET['id'])) {
    $id = $_GET["id"];

    $stmt = $conn->prepare("DELETE FROM `notes` WHERE id = ?");
    $stmt->bind_param("i", $id);
    $result = $stmt->execute();

    if ($result) {
        header("Location: notes.php?msg=note deleted successfully");
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
}
?>
