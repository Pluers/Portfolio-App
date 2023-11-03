<?php
if (isset($_POST['deleteUser'])) {
    // delete alle foreign keys van de gerelateerde tabellen
    customStatement(
        'DELETE FROM user_hobbies WHERE users_id = :user_id',
        [':user_id' => $user_id]
    );
    customStatement(
        'DELETE FROM user_education WHERE users_id = :user_id',
        [':user_id' => $user_id]
    );
    customStatement(
        'DELETE FROM user_jobexperiences WHERE users_id = :user_id',
        [':user_id' => $user_id]
    );
    // delete user
    customStatement(
        'DELETE FROM users WHERE users_id = :user_id',
        [':user_id' => $user_id]
    );
}



redirect('/logout');
