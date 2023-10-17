<?php
$App = parse_ini_file("env.ini", true);
$dbconn = $App['database'];
$servername = $App['database']['servername'];
$username = $App['database']['username'];
$password = $App['database']['drowssap'];
$dbname = $App['database']['dbname'];

// TEST CONNECTION
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Prepare the sql statement
function sqlStatement($conn, $sql)
{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
