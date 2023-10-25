<?php

function edituserinfo()
{

    // session met user
    $_SESSION['users_id'] = 2;
    if (isset($_POST['edituser'])) {
        if (isset($_POST['username'])) {

            $sql = "UPDATE users set username = " . $_POST['username'] . " where " . $_SESSION['users_id'] . " = users_id";
            customStatement($sql);
        }
    }
}


require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';

