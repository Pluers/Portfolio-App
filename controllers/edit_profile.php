<?php

function edituserinfo()
{
    // session met user
    $_SESSION['users_id'] = 2;
    if (isset($_POST['edituser'])) {
        if (isset($_POST['username'])) {
            customStatement("UPDATE users SET username = " . $_POST['username'] . " WHERE " . $_SESSION['users_id'] . " = users.users_id");
            $_POST['username'] = customStatement("SELECT username FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id");
            $_SESSION['username'] = $_POST['username'];
        }
    }
}


require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
