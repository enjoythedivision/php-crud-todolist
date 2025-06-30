<?php
require('functions/userFunctions.php');
require('functions/config.php');

session_start();
access();

$welcome_message = "Hi, " . $_SESSION['loggedUserName'];
$id = $_GET["id"];

if (isset($_POST["submit"])) {
    $content = $_POST['content'];

    $sql = "UPDATE `notes` SET `content`=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $content, $id);
    $result = $stmt->execute();

    if ($result) {
        header("Location: notes.php?msg=note updated successfully");
    } else {
        echo "Failed: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }

        body {
            overflow-x: hidden;
            font-family: 'Nunito', sans-serif;
        }

        #sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #f90;
            padding-top: 20px;
        }

        #sidebar a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 18px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        #sidebar a:hover {
            color: #f1f1f1;
        }

        #sidebar .bottom-links {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px 0;
        }

        #sidebar .bottom-links a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 16px;
            color: #fff;
            display: block;
            transition: 0.3s;
        }

        #sidebar .bottom-links a:hover {
            color: #f1f1f1;
        }

        #content1 {
            margin-left: 250px;
            padding: 16px;
        }

        #sidebar .btn-primary {
            width: 100%;
            padding: 8px 8px 8px 32px;
            text-align: left;
            font-size: 18px;
            transition: 0.3s;
            background-color: #f90;
            border-color: #f90;
        }


        .btn-primary {
            width: 30%;
            font-size: 18px;
            transition: 0.3s;
            background-color: #f90;
            border-color: #f90;
        }

        .btn-primary:hover {
            width: 30%;
            font-size: 18px;
            transition: 0.3s;
            background-color: #FFE5CC;
            border-color: #FFE5CC;

        }
    </style>
    <title>To do list | Edit note</title>
</head>

<body>

    <div id="sidebar">
        <a href="#" style="font-size: 25px;"><?php echo $welcome_message; ?>!</a>
        <a href="todo.php">Dashboard</a>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">New task</button>
        <a href="notes.php">Notes</a>

        <div class="bottom-links">
            <a href="edit_profile.php">Edit Profile</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div id="content1">
        <div class="container mt-4">
            <div class="text-center mb-4">
                <h1><b>Edit note</b></h1>
                <p class="text-muted">Click update after changing any information</p>
            </div>

            <?php
            $sql = "SELECT * FROM notes WHERE id = $id LIMIT 1";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            ?>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="content">Content:</label>
                                <input type="text" class="form-control" id="content" name="content" value="<?php echo $row['content'] ?>">
                            </div>


                            <div class="form-group">
                                <button type="submit" class="btn btn-primary" name="submit">Update</button>
                                <a href="notes.php" class="btn btn-primary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">New Task:</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="submit_task.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="taskTitle">Title:</label>
                        <input type="text" class="form-control" id="taskTitle" name="taskTitle" placeholder="Enter task title">
                    </div>

                    <div class="form-group">
                        <label>Priority:</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority" id="normalPriority" value="normal" checked>
                            <label class="form-check-label" for="normalPriority">
                                Normal
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="priority" id="urgentPriority" value="urgent">
                            <label class="form-check-label" for="urgentPriority">
                                Urgent
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="taskDescription">Description:</label>
                        <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" placeholder="Enter task description"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
</div>

</html>