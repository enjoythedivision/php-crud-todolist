<?php
require_once 'config.php'; // make sure config.php returns $conn or creates global $conn

function defaultConnectToDatabase() {
    global $conn; // use the connection from config.php
    if (!$conn) {
        die("No database connection available.");
    }
    return $conn;
}

function checkEmptyInput($parameter, $message = '') {
    if(empty($parameter)) {
        echo $message . "<br>";
        return true;
    }
}

function exitOnEmptyInput($parameter, $message = ''): void {
    if(empty($parameter)) {
        exit($message);
    }
}

function selectFromDbSimple($sql): array 
{
    exitOnEmptyInput($sql, "Empty 'select' query in line: " . __LINE__);

    $conn = defaultConnectToDatabase();
    $result = $conn->query($sql);
    $data = [];

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Do NOT close $conn here, it is shared
    return $data;
}

function executeQuery($sql) 
{
    exitOnEmptyInput($sql, "Empty query in line: " . __LINE__);

    $conn = defaultConnectToDatabase();
    $result = $conn->query($sql);

    if(!$result) {
        echo "Query execution failure!<br>" . $conn->error . "<br>" . $sql . "<br>";
    } else {
        echo "Query execution success!<br>" . $sql . "<br>";
    }

    // Do NOT close $conn here, it is shared
}
?>
