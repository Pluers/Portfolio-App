<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$conn = new Connection(
    $databaseInfo['servername'],
    $databaseInfo['dbname'],
    $databaseInfo['username'],
    $databaseInfo['drowssap']
);
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    $token = $_GET['token'];
    $sql = 'SELECT email FROM users WHERE reset_token = :reset_token';
    $stmt = $conn->conn->prepare($sql);
    $stmt->bindParam(':reset_token', $token);
    $stmt->execute();
    $email = $stmt->fetchColumn();

    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/reset_password.view.php';
    return;
}

$password = $_POST['password'];
$passwordHashed = password_hash($password, PASSWORD_ARGON2I);
$sql = 'UPDATE users SET drowssap = :password, reset_token = null WHERE reset_token = :reset_token';
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':password', $passwordHashed);
$stmt->bindParam(':reset_token', $_POST['reset_token']);
$stmt->execute();

redirect('/login');