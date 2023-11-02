<?php
if (isset($_POST['delete_hobby_user'])) {
    customStatement(
        'DELETE FROM user_hobbies 
    WHERE hobbies_id = (
        SELECT hobbies_id 
        FROM hobbies 
        WHERE hobby_name = :hobby_name
    )
    AND users_id = :user_id',
        [':hobby_name' => $_POST['deleteHobbyUser'], ':user_id' => $user_id]
    );
}


redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
