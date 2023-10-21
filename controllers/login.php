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
// is there any record of this user & password combination?
$sql = "SELECT count(*) FROM users WHERE username = :username AND drowsapp = :password";
$result = $conn->conn->prepare($sql);
// sql injection prevention https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/
$result->bindParam(':username', $username);
$result->bindParam(':password', $password);
$result->execute();
$number_of_rows = $result->fetchColumn();

if ($number_of_rows > 0) {
    redirect('/'); // ingelogd!
}

redirect('/login?error=1'); // gebruiker onbekend