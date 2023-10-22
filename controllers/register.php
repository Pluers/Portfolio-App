<?php
require '../core/functions.php';
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

$passwordHashed = password_hash($password, PASSWORD_ARGON2I);

$sql = "SELECT count(*) FROM users WHERE username = :username";
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->execute();
$number_of_rows = $stmt->fetchColumn();

if ($number_of_rows > 0) {
    redirect('/register?error=1'); // gebruiker bestaat al
}

$sql = "INSERT INTO users (username, drowsapp) VALUE (:username, :passwordHashed)";
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':passwordHashed', $passwordHashed);
$stmt->execute();
redirect('/login');