<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Nunito', sans-serif;
        }

        .container {
            max-width: 100%;
        }

        .btn-main-page {
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            font-weight: bold;
        }

        .left-half {
            background-color: #f90;
            height: 100vh;
        }

        .orange-content {
            padding: 20px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center-form {
            max-width: 400px;
            width: 100%;
        }

        .center-form form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .center-form input,
        .center-form button {
            width: 100%;
            margin-bottom: 10px;
        }

        .btn-primary {
            background-color: #FFE5CC;
            border: none;
        }

        .right-half {
            background-color: #fff;
            height: 100vh;
        }

        .center-image {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .center-image img {
            max-width: 100%;
            height: auto;
        }

        .signup-text a {
            color: #330033;
        }

        .signup-text a:hover {
            color: #330033;
        }

        .btn-primary:hover {
            background-color: #330033;
        }
    </style>
    <title>To-do list</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 left-half">
                <div class="orange-content">
                    <h2>Welcome to your to-do list!</h2>
                    <h5>Keep your tasks and notes in handy. Log in to get started.</h5>
                    <br>

                    <?php
                    require('functions/userFunctions.php');
                    require('functions/genericFunctions.php');
                    startSession();
                    showLoggedUser();
                    ?>

                    <div class="center-form">
                        <?php
                        if (isset($_SESSION['status'])) {
                        ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <?= $_SESSION['status']; ?>
                            </div>
                        <?php
                            unset($_SESSION['status']);
                        }
                        ?>

                        <form action="servers/loginServer.php" method="POST">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Insert UserName" style="width: 400px;">
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Insert Password" style="width: 400px;">
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>

                        <p class="signup-text">Don't have an account yet? <a href="register.php">Sign up here!</a></p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 right-half">
                <div class="center-image">
                    <img src="images/2.jpg" alt="Your Image">
                </div>
            </div>
        </div>
    </div>
</body>

</html>