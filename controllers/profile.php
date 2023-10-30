<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
global $conn;


if (isset($_GET['user_id'])) {
    $userId = $_GET['user_id'];
} else {
    $userId = $_SESSION[SESSION_KEY_USER_ID];
}
$sql = 'SELECT * FROM users WHERE users_id = :users_id';
$stmt = $conn->prepare($sql);
// sql injection prevention https://www.acunetix.com/blog/articles/prevent-sql-injection-vulnerabilities-in-php-applications/
$stmt->bindParam(':users_id', $userId);
$stmt->execute();
$user = $stmt->fetch();



    if (file_exists($target_dir_img . "profile_picture_" . $userId . ".jpg")) {
        $profileimg = "profile_picture_" . $userId . ".jpg";
    } else {
        $profileimg = "default.png";
    }
    require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
