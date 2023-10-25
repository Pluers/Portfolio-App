<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/forgot_password.view.php';
    return;
}

$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$conn = new Connection(
    $databaseInfo['servername'],
    $databaseInfo['dbname'],
    $databaseInfo['username'],
    $databaseInfo['drowssap']
);

// post de email
$email = strtolower($_POST['email']);

// maakt een token met een lengte van 16 characters
$token = bin2hex(random_bytes(16));

// hashed de token in de database
$token_hash = hash("sha256", $token);

// geeft een tijdframe mee aan de token. in dit geval heb je 5 minuten voor de token expired.
$expire = date("Y-m-d H:i:s", time() + 60 * 5);

$sql = "UPDATE users SET reset_token = :reset_token,
                reset_token_expires_at = :reset_token_expires_at WHERE email = :email";

$stmt = $conn->conn->prepare($sql);

$stmt->bindParam(':email',$email);
$stmt->bindParam(':reset_token',$token_hash);
$stmt->bindParam(':reset_token_expires_at',$expire);

$stmt->execute();

$link = '/reset-password?token='.$token_hash;
if (retrieveConfigurationSettingsFromIni('settings')['mail'] === false) {
    redirect($link);
    return;
}
mail($email, 'Forgot password', sprintf('Click here to reset your password: %s, this link will expire in 5 minutes.', $link));
