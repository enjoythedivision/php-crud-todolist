<?php

function existsActiveUserSession() 
{
    return session_status() === 2;
}

function existsLoggedUser()
{
    return isset($_SESSION['loggedUserName']) && isset($_SESSION['loggedUserID']);
}


function showLoggedUser() 
{    
    if(existsLoggedUser()) {
        header('Refresh: 10; URL=todo.php');
        echo "You are already logged in!" . "<br>"
            . "Logged user: " . $_SESSION['loggedUserName'] . "<br>Redirecting you to the homepage in 10 seconds...";
    } 
    
}

function logUserIn($userName, $id)
{
    if(!existsLoggedUser()) {
        $_SESSION['loggedUserName'] = $userName;
        $_SESSION['loggedUserID'] = $id; // fetch user id

        return true;
    }

    return false;    
}

function logUserOut()
{
    if (existsLoggedUser()) {
        $userName = $_SESSION['loggedUserName'];
        
        unset($_SESSION['loggedUserName']);
        unset($_SESSION['loggedUserID']);

        if(existsLoggedUser()) {
            echo "Failed to log out user: $userName";
        } else {
            echo "Successfully logged user out" . "<br>" . $userName;
        }
    } else {
        echo "No user to log out!"  . "<br>";
    }
}


function access()
{
    if (!isset($_SESSION['loggedUserName'])){
        exit('<a href="../index.php">Log in to gain access!</a>');
    } 
};
?>