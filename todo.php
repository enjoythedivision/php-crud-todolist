<?php
require('functions/userFunctions.php');
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
require('functions/config.php');
session_start();
access();

$welcome_message = "Hi, " . $_SESSION['loggedUserName'];
$id = $_SESSION['loggedUserID'];

$sql = "SELECT * FROM tasks WHERE status = 'pending'";
$result = $conn->query($sql);
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

    #content {
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

    #tasks-container a {
      color: #330033;
    }
    
  </style>
  <title>To-do list | Dashboard</title>
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

<div id="content">
 <div class="container mt-4">
  <?php if (isset($_SESSION['status'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['status']; unset($_SESSION['status']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['status'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['status']; unset($_SESSION['status']); ?>
    </div>
<?php endif; ?>
<?php if (isset($_SESSION['status'])): ?>
    <div class="alert alert-success text-center">
        <?= $_SESSION['status']; unset($_SESSION['status']); ?>
    </div>
<?php endif; ?>

    <form>
      <h1><b>To-dos</b></h1>
      <label>
        <input type="radio" name="page" value="page1" checked>
        Show me tasks marked as 'normal'
      </label><br>
      <label>
        <input type="radio" name="page" value="page2">
        Show me tasks marked as 'urgent'
      </label>
    </form><br>

    <div id="page1" class="page-content">
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container">
              <h4 class="card-title">Pending</h4>
              <p class="card-text">
                <?php
                $sql = "SELECT * from tasks WHERE status = 'pending' AND type = 'normal' AND user_id = '$id'";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container">
              <h4 class="card-title">In progress...</h4>
              <p class="card-text"><?php
                                    $sql = "SELECT * from tasks WHERE status = 'in_progress' AND type = 'normal' AND user_id = '$id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container">
              <h4 class="card-title">Done</h4>
              <p class="card-text"> <?php
                                    $sql = "SELECT * from tasks WHERE status = 'done' AND type = 'normal' AND user_id = '$id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="page2" class="page-content hidden">
      <div class="row">
        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container">
              <h4 class="card-title">Pending</h4>
              <p class="card-text"> <?php
                                    $sql = "SELECT * from tasks WHERE status = 'pending' AND type = 'urgent' AND user_id = '$id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>

              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container"> <!-- id edit -->
              <h4 class="card-title">In progress...</h4>
              <p class="card-text"><?php
                                    $sql = "SELECT * from tasks WHERE status = 'in_progress' AND type = 'urgent' AND user_id = '$id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>
              </p>
            </div>
          </div>
        </div>

        <div class="col-md-4 mb-4">
          <div class="card">
            <div class="card-body" id="tasks-container"> <!-- id edit -->
              <h4 class="card-title">Done</h4>
              <p class="card-text"> <?php
                                    $sql = "SELECT * from tasks WHERE status = 'done' AND type = 'urgent' AND user_id = '$id'";
                                    $result = $conn->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                  <tr>
                    <td><b><?php echo $row["title"] ?></b></td><br>
                    <td><i><?php echo $row["description"] ?></i></td>
                    <td>
                      <a href="edit_task.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                      <a href="delete_task.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                    </td><br>
                  </tr>
                <?php } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const radioButtons = document.querySelectorAll('input[name="page"]');
      const pages = document.querySelectorAll('.page-content');

      radioButtons.forEach(function(radioButton) {
        radioButton.addEventListener('change', function() {
          const selectedPageId = this.value;

          // hide all pages
          pages.forEach(function(page) {
            page.classList.add('hidden');
          });

          // show the selected page
          const selectedPage = document.getElementById(selectedPageId);
          selectedPage.classList.remove('hidden');
        });
      });
    });
  </script>
</body>

<!-- modal -->
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
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</html>