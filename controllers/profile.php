<?php
global $conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
}

$userHobbies =
    customStatement('SELECT * FROM user_hobbies JOIN hobbies on user_hobbies.hobbies_id = hobbies.hobbies_id WHERE user_hobbies.users_id = :user_id', [':user_id' => $user_id]);

// haal user id op
$sql = 'SELECT * FROM users WHERE users_id = :users_id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':users_id', $user_id);
$stmt->execute();
$user = $stmt->fetch();

if (file_exists($targetDirImage . "profile_picture_" . $user_id . ".jpg")) {
    $profileImage = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileImage = "default.png";
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
