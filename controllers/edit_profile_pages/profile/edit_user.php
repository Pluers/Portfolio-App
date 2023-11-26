<?php

global $targetDirImage, $profileImage;

if (isCurrentUserAllowedToEditUser() === false) {
    redirect('/profile');
}

// update profile
customStatement(
    'UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email, description = :description WHERE users_id = :user_id',
    [
        ':user_id' => $user_id,
        ':first_name' => $_POST['first_name'],
        ':last_name' => $_POST['last_name'],
        ':email' => $_POST['email'],
        ':description' => $_POST['description'] ?? null,
    ]
);

redirect('/editprofile?tab=profile&user_id=' . $user_id);
