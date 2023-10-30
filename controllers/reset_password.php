<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
global $conn;

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    $token = $_GET['token'];
    $sql = 'SELECT email, reset_token_expires_at FROM users WHERE reset_token = :reset_token';
    $stmt = $conn->conn->prepare($sql);
    $stmt->bindParam(':reset_token', $token);
    $stmt->execute();
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

$sql = 'SELECT reset_token_expires_at FROM users WHERE reset_token = :reset_token';
$stmt = $conn->conn->prepare($sql);
$stmt->bindParam(':reset_token', $_POST['reset_token']);
$stmt->execute();
$expiresAt = $stmt->fetchColumn();
if (isset($expiresAt) && (strtotime($expiresAt) < time())) {
    echo "Token has expired.";
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