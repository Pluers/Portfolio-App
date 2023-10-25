<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/register.view.php';
    return;
}

$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$conn = new Connection(
    $databaseInfo['servername'],
    $databaseInfo['dbname'],
    $databaseInfo['username'],
    $databaseInfo['drowssap']
);

$username = strtolower($_POST['username']);
$firstname = strtolower($_POST['firstname']);
$lastname = strtolower($_POST['lastname']);
$email = strtolower($_POST['email']);
$password = $_POST['password'];

$passwordHashed = password_hash($password, PASSWORD_ARGON2I);

$sql = "SELECT username, email FROM users WHERE username = :username OR email = :email";
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch();
if (!empty($result['username']) && $result['username'] === $username) {
    redirect('/register?error=1'); // gebruiker bestaat al
} else if (!empty($result['email']) && $result['email'] === $email) {
    redirect('/register?error=2'); // email bestaat al
}

$sql = "INSERT INTO users (username, first_name, last_name, email, drowssap) VALUES (:username, :firstname, :lastname, :email, :passwordHashed)";
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':username', $username);
$stmt->bindParam(':firstname', $firstname);
$stmt->bindParam(':lastname', $lastname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':passwordHashed', $passwordHashed);
$stmt->execute();
redirect('/login');
