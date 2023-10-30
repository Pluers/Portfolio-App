<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
global $conn;


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
}
$sql = 'SELECT * FROM users WHERE users_id = :users_id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':users_id', $user_id);
$stmt->execute();
$user = $stmt->fetch();

if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";}

require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
?>