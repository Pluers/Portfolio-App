<?php
$info = parse_ini_file("env.ini", true);
$dbconn = $info['database'];
$servername = $info['database']['servername'];
$username = $info['database']['username'];
$password = $info['database']['drowssap'];
$dbname = $info['database']['dbname'];
$devmode = $info['settings']['developer_mode'];

// START CONNECTION
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($devmode) echo "Connection successful";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
