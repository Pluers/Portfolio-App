<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/login.view.php';
    return;
}

global $conn;

$email = strtolower($_POST['email']);
$password = $_POST['password'];

// is there any record of this user & password combination?
$sql = 'SELECT drowssap, users_id FROM users WHERE email = :email';
$stmt = $conn->conn->prepare($sql);
// sql injection prevention https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch();
if ($result === false) {
    redirect('/login?error=1'); // gebruiker onbekend
}

if (password_verify($password, $result['drowssap']) === true) {
    $_SESSION[SESSION_KEY_USER_ID] = $result['users_id'];
    redirect('/'); // ingelogd!
}

redirect('/login?error=1'); // wachtwoord incorrect