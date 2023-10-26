<?php

function editUserInfo()
{
    // session met user
    $_SESSION['users_id'] = 1;
    if (isset($_POST['edituser'])) {
        if (isset($_POST['username'])) {
            try {
                customStatement("UPDATE users SET username = " . $_POST['username'] . " WHERE " . $_SESSION['users_id'] . " = users.users_id");
                var_dump($_POST['username']);
            } catch (PDOException $e) {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
function updateUserInfo()
{
    $getUsername = customStatement("SELECT username FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id");
    $getFirstName = customStatement("SELECT first_name FROM users WHERE " . $_SESSION['users_id'] . " = users.users_id");

    return [
        "username" => $getUsername,
        "firstName" => $getFirstName
    ];
}
function getUserInfo()
{
    foreach (updateUserInfo() as $statementresults => $statementresult) {
        foreach ($statementresult as $results) {
            foreach ($results as $value) {
                echo $value;
                $_SESSION['username'] = $value;
            }
        }
    }
}



require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
