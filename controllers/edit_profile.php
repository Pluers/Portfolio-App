<?php
function getUserInfo()
{
    echo $_SESSION['user_id'] = 1;
    // return var_dump(customStatement("SELECT first_name, last_name, email from users WHERE users_id = '" . $_SESSION['user_id'] . "'", ""));
    return [
        "first_name" => customStatement("SELECT first_name FROM users WHERE users_id = " . $_SESSION['users_id'], ""),
        "last_name" => customStatement("SELECT last_name FROM users WHERE users_id = " . $_SESSION['users_id'], ""),
        "email" => customStatement("SELECT email FROM users WHERE users_id = " . $_SESSION['users_id'], ""),
    ];
}

$_SESSION['user_id'] = 1;
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/views/public/images/";
$user_id = $_SESSION['user_id'];
if (isset($_POST['edituser'])) {
    customStatement("UPDATE users SET first_name = '" . $_POST['firstName'] . "', last_name = '" . $_POST['lastName'] . "', email= '" . $_POST['email'] . "' WHERE users_id = :user_id", [':user_id' => $user_id]);
}
// check if profile picture exists
if (file_exists($target_dir . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";
}
if (isset($_POST['uploadpfp'])) {
    $target_file = $target_dir . "profile_picture_" . $user_id . ".jpg";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
        }
    }
}






require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
