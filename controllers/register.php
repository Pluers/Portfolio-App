<?php
require  '../core/functions.php';
require_once '../core/db.php';

$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$conn = new Connection(
    $databaseInfo['servername'],
    $databaseInfo['dbname'],
    $databaseInfo['username'],
    $databaseInfo['drowssap']
);

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "select count(*) from users where username = '$username'";
$result = $conn->conn->prepare($sql);
$result->execute();
$number_of_rows = $result->fetchColumn();
if ($number_of_rows > 0) {
    redirect('/register');
}

$sql = "insert into users (username, drowsapp) value ('$username', '$password')";

$stmt = $conn->conn->prepare($sql);
$stmt->execute();
redirect('/login');