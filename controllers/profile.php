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
$stmt->execute([':users_id' => $user_id]);
$user = $stmt->fetch();

$profileImagePath = $targetDirImage . "profile_picture_" . $user_id . ".jpg";
$profileImage = file_exists($profileImagePath) ? "profile_picture_" . $user_id . ".jpg" : "default.png";

if (isset($_POST['deleteUser'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/delete_user.php';
    return;
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
