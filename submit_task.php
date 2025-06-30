<?php
require('functions/userFunctions.php');
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
session_start();
require('functions/config.php');

$title = $_POST['taskTitle'];
$description = $_POST['taskDescription'];
$type = $_POST['priority'];
$id = $_SESSION['loggedUserID'];

$stmt = $conn->prepare("INSERT INTO tasks (user_id, title, description, type) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $id, $title, $description, $type);

if ($stmt->execute()) {
$_SESSION['status'] = "Task submitted!";
header("Location: todo.php");
 exit;
} else {
    echo "ERROR: Could not execute query: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
