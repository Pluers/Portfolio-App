<?php
global $conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    $token = $_GET['token'];
    $sql = 'SELECT email, reset_token_expires_at FROM users WHERE reset_token = :reset_token';
    $stmt = $conn->prepare($sql);
    $stmt->execute([':reset_token' => $token]);
    $result = $stmt->fetch();
    if ($result === false) {
        redirect('/forgot?error=1');
    }
    if (isset($result['reset_token_expires_at']) && (strtotime($result['reset_token_expires_at']) < time())) {
        redirect('/forgot?error=2');
        return;
    }
    $email = $result['email'];
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/reset_password.view.php';
    return;
}

// er wordt hier gekeken naar de tijd die meegegeven is met de reset token. op het moment dat de tijd verlopen is krijg je een token expired error.
$sql = 'SELECT reset_token_expires_at FROM users WHERE reset_token = :reset_token';
$stmt = $conn->prepare($sql);
$stmt->execute([':reset_token' => $_POST['reset_token']]);
$expiresAt = $stmt->fetchColumn();
if (isset($expiresAt) && (strtotime($expiresAt) < time())) {
    echo "Token has expired.";
    return;
}

// hier wordt het nieuwe wachtwoord gehashed.
$password = $_POST['password'];
$passwordHashed = password_hash($password, PASSWORD_ARGON2I);
$sql = 'UPDATE users SET drowssap = :password, reset_token = null WHERE reset_token = :reset_token';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':password' => $passwordHashed,
    ':reset_token' => $_POST['reset_token']
]);

redirect('/login');
