<?php
function getUserInfo()
{
    echo $_SESSION['users_id'];
    $getUsers = customStatement("SELECT * FROM users WHERE users_id = :users_id", [':users_id' => $_SESSION['users_id']]);
    return $getUsers;
}

$_SESSION['users_id'] = 1;
$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/views/public/images/";
$users_id = $_SESSION['users_id'];
if (isset($_POST['edituser'])) {
    customStatement("UPDATE users SET first_name = '" . $_POST['firstName'] . "', last_name = '" . $_POST['lastName'] . "', email= '" . $_POST['email'] . "' WHERE users_id = :users_id", [':users_id' => $users_id]);
}
// check if profile picture exists
if (file_exists($target_dir . "profile_picture_" . $users_id . ".jpg")) {
    $profileimg = "profile_picture_" . $users_id . ".jpg";
} else {
    $profileimg = "default.png";
}
if (isset($_POST['uploadpfp'])) {
    $target_file = $target_dir . "profile_picture_" . $users_id . ".jpg";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $users_id . ".jpg";
        }
    }
}






require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
