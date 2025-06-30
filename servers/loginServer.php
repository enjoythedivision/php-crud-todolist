<a href="../index.php">Go back</a>
<br> <br>

<?php 
require('../functions/userFunctions.php'); 
require('../functions/genericFunctions.php'); 
require('../functions/databaseFunctions.php'); 

startSession();

if(isRequestMethodPost()) {
    $userName = addslashes($_POST['username']);
    $password = addslashes($_POST['password']);

    if(isset($userName) && isset($password)) {
        $sql = "SELECT user_name, id, password
                FROM users
                WHERE user_name = '{$userName}' AND password = '{$password}'";

        $data = selectFromDbSimple($sql);

        if(!empty($data)) {
            foreach($data as $userCredentials) {
                $loginOutcome = logUserIn($userCredentials['user_name'], $userCredentials['id']);

                if($loginOutcome) {
                    redirectTo("../todo.php");
                } else {          
                    echo "Another user is already logged in!";
                }
            }
        } else {
            $_SESSION['status'] = "Wrong username or password.";
            redirectTo("../index.php");
        }
    }
} else {
    setError("Tried to send data without 'Post' Method!");
    redirectTo("../errorPage.php");
}
?>