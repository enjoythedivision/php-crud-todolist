A simple PHP and MySQL CRUD application that allows registered users to manage tasks and personal notes. Built for learning purposes as a study project.

---

## Features

- User registration and login
- Add, edit, and delete to-do tasks
- Task statuses: pending, in progress, done
- Task priority types: normal, urgent
- Add, edit, and delete personal notes
- Timestamp tracking for tasks and notes
- Clean and minimal user interface

---

## Technologies

- PHP (procedural)
- MySQL
- HTML / CSS / basic JavaScript
- No frameworks (for learning clarity)

---

## Setup Instructions

### 1. Clone the Repository

```

git clone https://github.com/enjoythedivision/php-crud-todolist.git
cd php-crud-todolist

````

### 2. Import the SQL Database

- Use phpMyAdmin or the MySQL CLI to import `sample_db.sql`
- This will create a database called `todolist` with three tables:
  - `users`
  - `tasks`
  - `notes`

### 3. Create Your `config.php` File

In the `/functions/` folder, create a file named `config.php`:

```php
<?php
$servername = "localhost";
$username = "your_username";
$password = "your_password";
$dbname = "todolist";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
````

Note: `config.php` is excluded from GitHub using `.gitignore`.

### 4. Run the App

Start a local PHP server from your project root:

```
php -S localhost:8000
```

Then visit `http://localhost:8000` in your browser.

---

## Notes

This is a basic educational/demo project. In a real-world app, you'd want to:

* Use password hashing (`password_hash()` and `password_verify()`)
* Validate and sanitize all inputs
* Add CSRF protection
* Handle sessions securely
* Prevent SQL injection
