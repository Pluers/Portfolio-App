<?php

global $conn;

if (!empty($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $getHobbies = customStatement('SELECT * FROM hobbies');
    $userHobbies = customStatement('SELECT * FROM user_hobbies JOIN hobbies on user_hobbies.hobbies_id = hobbies.hobbies_id WHERE user_hobbies.users_id = :user_id', [':user_id' => $user_id]);
    $hobbyName = $_POST['create_hobby_name'] ?? 'default';
    $user = getUserInfo($user_id);
    // check of de profiel foto bestaat.
    if (file_exists($targetDirImage . "profile_picture_" . $user_id . ".jpg")) {
        $profileImage = "profile_picture_" . $user_id . ".jpg";
    } else if (file_exists($targetDirImage . "hobby_" . $hobbyName . ".jpg")) {
        $hobbyimg = "hobby_" . $hobbyName . ".jpg";
    } else {
        $hobbyimg = "default_hobby.jpg";
        $profileImage = "default.png";
    }

    require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
    return;
}

// check de forms en doe sql querys.
if (isset($_POST['edituser'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/profile/edit_user.php';
    return;
} else if (isset($_POST['uploadpfp'])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/profile/upload_profile_picture.php';
    return;
} else if (isset($_POST["delete_hobby"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/hobbies/delete_hobby.php';
    return;
} else if (isset($_POST["delete_hobby_user"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/hobbies/delete_hobby_user.php';
    return;
} else if (isset($_POST["add_hobby_to_profile"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/hobbies/link_hobby_user.php';
    return;
} else if (isset($_POST["create_hobby"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/hobbies/create_hobby.php';
    return;
} else if (isset($_POST["create_education"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/educations/create_education.php';
    return;
} else if (isset($_POST["delete_education"])) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/controllers/edit_profile_pages/educations/delete_education.php';
    return;
}

redirect('editprofile?tab=' . $_GET['tab']);
