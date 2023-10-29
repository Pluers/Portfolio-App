<?php
function getUserInfo()
{
    global $conn;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    $stmt = $conn->prepare("SELECT * FROM users WHERE users_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
    }
}

$_SESSION[SESSION_KEY_USER_ID] = 1;
$user_id = $_SESSION[SESSION_KEY_USER_ID];
if (isset($_POST['edituser'])) {
    customStatement("UPDATE users SET first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', email= '" . $_POST['email'] . "' WHERE users_id = :user_id", [':user_id' => $user_id]);
}
// check if profile picture exists
if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";
}
if (isset($_POST['uploadpfp'])) {
    $target_file = $target_dir_img . "profile_picture_" . $user_id . ".jpg";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
        }
    }
}






require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
