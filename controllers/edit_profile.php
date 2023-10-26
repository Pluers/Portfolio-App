<?php

function editUserInfo()
{
    $_SESSION['users_id'] = 2;
    if (isset($_POST['edituser'])) {
        customStatement("UPDATE users SET username = '" . $_POST['username'] . "' WHERE " . $_SESSION['users_id'] . " = users.users_id");
        customStatement("UPDATE users SET first_name = '" . $_POST['firstName'] . "' WHERE " . $_SESSION['users_id'] . " = users.users_id");
        customStatement("UPDATE users SET last_name = '" . $_POST['lastName'] . "' WHERE " . $_SESSION['users_id'] . " = users.users_id");
        customStatement("UPDATE users SET email = '" . $_POST['email'] . "' WHERE " . $_SESSION['users_id'] . " = users.users_id");
    }
}
function loopGetinfo($sql)
{
    foreach ($sql as $statementresults => $statementresult) {
        foreach ($statementresult as $results) {
            return $results;
        }
    }
}
function updateUserInfo()
{
    return [
        "username" => loopGetinfo(customStatement("SELECT username FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id")),
        "firstName" => loopGetinfo(customStatement("SELECT first_name FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id")),
        "lastName" => loopGetinfo(customStatement("SELECT last_name FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id")),
        "email" => loopGetinfo(customStatement("SELECT email FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id")),
    ];
}
if (isset($_POST['upload'])) {
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/views/public/images/";
    $user_id = $_SESSION['users_id'];
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
