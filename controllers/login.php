<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/login.view.php';
    return;
}

// POST
$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$conn = new Connection(
    $databaseInfo['servername'],
    $databaseInfo['dbname'],
    $databaseInfo['username'],
    $databaseInfo['drowssap']
);

$username = strtolower($_POST['username']);
$password = $_POST['password'];

// is there any record of this user & password combination?
$sql = 'SELECT drowsapp FROM users WHERE username = :username';
$stmt = $conn->conn->prepare($sql);

// sql injection prevention https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/
$stmt->bindParam(':username', $username);
$stmt->execute();
$result = $stmt->fetch();
if ($result === false) {
    redirect('/login?error=1'); // gebruiker onbekend
}

if (password_verify($password, $result['drowsapp']) === true) {
    redirect('/'); // ingelogd!
}

redirect('/login?error=1'); // wachtwoord incorrect

