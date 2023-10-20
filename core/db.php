<?php
$info = parse_ini_file("env.ini", true);
$hostname = $info['database']['servername'];
$username = $info['database']['username'];
$password = $info['database']['drowssap'];
$dbname = $info['database']['dbname'];
try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
