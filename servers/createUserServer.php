<?php
require('../functions/userFunctions.php');
require('../functions/genericFunctions.php');
require('../functions/databaseFunctions.php');

startSession();

if (isRequestMethodPost()) {
    $userData = [
        'user_name' => $_POST['username'],
        'email'     => $_POST['email'],
        'password'  => $_POST['password']
    ];

    $username = $userData['user_name'];

    $sql = "SELECT id
            FROM users
            WHERE user_name = '{$username}'";

    $data = selectFromDbSimple($sql);

    if (!empty($data)) {
        // exit("There is already a user with username '$username'");
        $_SESSION['status'] = "This username is taken. :(";
        redirectTo("../register.php");
    } else { ///else test

        $fields = "";
        $values = "";

        foreach ($userData as $field => $value) {
            if (!empty($value)) {
                $fields .= "$field, ";
                $values .= "'$value', ";
            }
        }

        $fields = rtrim($fields, ', ');
        $values = rtrim($values, ', ');

        $sql = "INSERT INTO users ({$fields}) 
            VALUES ({$values})";


        $_SESSION['status'] = "Profile created successfully! Log in to get started.";
        redirectTo("../index.php");
        executeQuery($sql);
    } //
} else {
    setError("Tried to send data without 'Post' Method!");
    redirectTo("../errorPage.php");
};
