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

    $getJobexperiences = customStatement('SELECT * FROM jobexperiences');
    $userJobexperiences = customStatement('SELECT * FROM user_jobexperiences JOIN jobexperiences on user_jobexperiences.jobexperiences_id = jobexperiences.jobexperiences_id WHERE user_jobexperiences.users_id = :user_id', [':user_id' => $user_id]);
    $jobexperienceName = $_POST['create_jobexperience_name'] ?? 'default';
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

// net als in de routes
$formToFileMap = [
    'edituser' => '/controllers/edit_profile_pages/profile/edit_user.php',
    'uploadpfp' => '/controllers/edit_profile_pages/profile/upload_profile_picture.php',
    'create_hobby' => '/controllers/edit_profile_pages/hobbies/create_hobby.php',
    'delete_hobby' => '/controllers/edit_profile_pages/hobbies/delete_hobby.php',
    'delete_hobby_user' => '/controllers/edit_profile_pages/hobbies/delete_hobby_user.php',
    'add_hobby_to_profile' => '/controllers/edit_profile_pages/hobbies/link_hobby_user.php',
    'create_jobexperience' => '/controllers/edit_profile_pages/jobexperiences/create_jobexperience.php',
    'add_jobexperience_to_profile' => '/controllers/edit_profile_pages/jobexperiences/link_jobexperience_user.php',
    'delete_jobexperience' => '/controllers/edit_profile_pages/jobexperiences/delete_jobexperience.php',
    'delete_jobexperience_user' => '/controllers/edit_profile_pages/jobexperiences/delete_jobexperience_user.php',
    'create_education' => '/controllers/edit_profile_pages/educations/create_education.php',
    'delete_education' => '/controllers/edit_profile_pages/educations/delete_education.php',
];

foreach ($formToFileMap as $form => $file) {
    if (isset($_POST[$form])) {
        require_once $_SERVER['DOCUMENT_ROOT'] . $file;
        return;
    }
}
redirect('editprofile?tab=' . $_GET['tab']);
