<?php 
require('functions/userFunctions.php'); 
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
session_start();
require('functions/config.php');

$welcome_message = "Hi, " . $_SESSION['loggedUserName'];

if (isset($_GET['id'])) {
    $id = $_GET["id"];
    
    $sql = "DELETE FROM `tasks` WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $_SESSION['status'] = "Task deleted successfully!";
        header("Location: todo.php");
        exit;
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
