<?php

function editUserInfo()
{
    $_SESSION['users_id'] = 3;
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





require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
