<?php

global $targetDirImage, $profileImage;

$user_id = $_SESSION[SESSION_KEY_USER_ID];

if ($_SESSION[SESSION_KEY_ADMIN] === 0 || $_SESSION[SESSION_KEY_ADMIN] === false) {
    if (isset($_GET['user_id']) && $_GET['user_id'] !== $_GET[SESSION_KEY_USER_ID]) {
        redirect('/profile');
    }
}

if (
    empty($_POST['first_name']) ||
    empty($_POST['last_name']) ||
    empty($_POST['email'])
    #!isset($_POST['description'])
) {
    throw new Exception('Cannot update these parameters without all the values filled in! ' . implode(', ', $_POST) );
}

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

redirect('/editprofile?tab=profile');