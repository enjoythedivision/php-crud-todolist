<?php
require('functions/userFunctions.php');
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
require('functions/config.php');
session_start();
access();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = mysqli_real_escape_string($conn, $_POST['note_content']);
    $id = $_SESSION['loggedUserID'];

    $sql = "INSERT INTO notes (user_id, content) VALUES ('$id', '$content')";

    if (mysqli_query($conn, $sql)) {
        header("Location: notes.php?message=Note%20submitted!");
        exit();
    } else {
        echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
