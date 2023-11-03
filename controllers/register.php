<?php
global $conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/register.view.php';
    return;
}

$firstname = ucfirst(strtolower($_POST['firstname']));
$lastname = ucfirst(strtolower($_POST['lastname']));
$email = strtolower($_POST['email']);
$password = $_POST['password'];

$passwordHashed = password_hash($password, PASSWORD_ARGON2I);

$sql = 'SELECT  email FROM users WHERE email = :email';
$stmt = $conn->prepare($sql);
$stmt->execute([':email' => $email]);
$result = $stmt->fetch();

if (!empty($result['email']) && $result['email'] === $email) {
    redirect('/register?error=2'); // email bestaat al
}

$sql = 'INSERT INTO users ( email, first_name, last_name, drowssap) VALUES (:email, :firstname, :lastname, :passwordHashed)';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':email' => $email,
    ':firstname' => $firstname,
    ':lastname' => $lastname,
    ':passwordHashed' => $passwordHashed
]);

redirect('/login');
