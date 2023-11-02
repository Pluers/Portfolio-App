<?php
global $conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

if (strtoupper($_SERVER['REQUEST_METHOD']) === 'GET') {
    require $_SERVER['DOCUMENT_ROOT'] . '/views/unauthorised/forgot_password.view.php';
    return;
}

// post de email.
$email = strtolower($_POST['email']);

// maakt een token met een lengte van 16 characters.
$token = bin2hex(random_bytes(16));

// hashed de token in de database.
$token_hash = hash("sha256", $token);

// geeft een tijdframe mee aan de token. in dit geval heb je 5 minuten voor de token expired.
$expire = date("Y-m-d H:i:s", time() + 60 * 5);

// hier wordt gekeken of de email exist.
$sql = 'SELECT email FROM users WHERE email = :email';
$stmt = $conn->prepare($sql);
$stmt->execute([':email' => $email]);
$result = $stmt->fetch();

if ($result === false) {
    redirect('/forgot?error=1');
}

/* hier updaten we de collumns die over de token en de expire gaan.
* en wordt je geredirect naar dezelfde pagina + er wordt een token meegegeven.
*/
$sql = 'UPDATE users SET reset_token = :reset_token, reset_token_expires_at = :reset_token_expires_at WHERE email = :email';
$stmt = $conn->prepare($sql);
$stmt->execute([
    ':email' => $email,
    ':reset_token' => $token_hash,
    ':reset_token_expires_at' => $expire
]);

$link = '/reset?token=' . $token_hash;
if (retrieveConfigurationSettingsFromIni('settings')['mail'] === false) {
    redirect($link);
    return;
}
