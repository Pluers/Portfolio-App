<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
global $conn;
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/login.view.php';
    return;
}

$email = strtolower($_POST['email']);
$password = $_POST['password'];

// is there any record of this user & password combination?
$sql = 'SELECT drowssap, users_id, isAdmin FROM users WHERE email = :email';
$stmt = $conn->prepare($sql);
// sql injection prevention https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/
$stmt->bindParam(':email', $email);
$stmt->execute();
$result = $stmt->fetch();
if ($result === false) {
    redirect('/login?error=1'); // gebruiker onbekend
}

if (password_verify($password, $result['drowssap']) === true) {
    $_SESSION[SESSION_KEY_USER_ID] = $result['users_id'];
    $_SESSION[SESSION_KEY_ADMIN] = $result['isAdmin'];
    redirect('/'); // ingelogd!
}

redirect('/login?error=1'); // wachtwoord incorrect