<?php
require('functions/userFunctions.php');
require('functions/genericFunctions.php');
require('functions/databaseFunctions.php');
require('functions/config.php');  // include config to get $conn

session_start();
access();

$welcome_message = "Hi, " . $_SESSION['loggedUserName'];
$id = $_SESSION['loggedUserID'];

// $conn is available here from config.php
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
  <title>To do list | Edit task</title>
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
      <div class="text-center mb-4">
        <h1><b>Notes</b></h1>
        <?php if (isset($_GET['message'])): ?>
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo htmlspecialchars($_GET['message']); ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<?php endif; ?>


      </div>
      <?php
      $sql = "SELECT * FROM notes WHERE id = $id LIMIT 1";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      ?>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <form action="submit_note.php" method="POST" style="max-width: 500px; margin: auto;">
              <div class="form-group">
                <label for="note_content" style="font-weight: bold; color: #495057;">Take a note:</label>
                <textarea class="form-control" id="note_content" name="note_content" rows="4" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Submit Note</button>
            </form><br><br>

            <div class="card">
              <div class="card-body" id="tasks-container">
                <h5 class="card-title">my notes:</h5>
                <p class="card-text">
                  <?php
                  $sql = "SELECT * from notes WHERE user_id = '$id'";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) {
                  ?>
                    <tr>
                      <td><?php echo $row["content"] ?></td>
                      <td>
                        <a href="edit_note.php?id=<?php echo $row["id"] ?>" class="link-dark">edit</a>
                        <a href="delete_note.php?id=<?php echo $row["id"] ?>" class="link-dark">delete</a>
                      </td><br>
                    </tr>
                  <?php } ?>
                </p>
              </div>
            </div>
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
      <form action="submit_task.php" method="post"> <!-- Updated action and method -->
        <div class="modal-body">
          <!-- Task Title Form -->
          <div class="form-group">
            <label for="taskTitle">Title:</label>
            <input type="text" class="form-control" id="taskTitle" name="taskTitle" placeholder="Enter task title">
          </div>

          <!-- Priority Radio Buttons -->
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

          <!-- Task Description Form -->
          <div class="form-group">
            <label for="taskDescription">Description:</label>
            <textarea class="form-control" id="taskDescription" name="taskDescription" rows="3" placeholder="Enter task description"></textarea>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button> <!-- Use type="submit" for form submission -->
        </div>
      </form>
    </div>
  </div>
</div>
</div>

</html>