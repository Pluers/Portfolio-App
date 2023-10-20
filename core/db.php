<?php
global $servername, $username, $password, $dbname, $devmode;

// START CONNECTION
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // prints a connected successful message if devmode is true
    if ($devmode) echo "Connection successful";
} catch (PDOException $e) {
    if ($devmode) echo "Connection failed: " . $e->getMessage();
}
