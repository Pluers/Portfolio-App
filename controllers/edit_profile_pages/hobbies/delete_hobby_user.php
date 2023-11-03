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

if (isset($_POST['deleteHobbyUser'])) {
    $hobbyName = $_POST['deleteHobbyUser'];
    customStatement(
        'DELETE user_hobbies FROM user_hobbies 
                            JOIN hobbies ON user_hobbies.hobbies_id = hobbies.hobbies_id 
                            WHERE user_hobbies.users_id = :user_id AND hobbies.hobby_name = :hobby_name',
        [':user_id' => $user_id, ':hobby_name' => $hobbyName]
    );
} else if (isset($_POST['deleteHobby'])) {
    customStatement(
        'DELETE FROM hobbies WHERE hobbies_id = :hobbies_id',
        [':hobbies_id' => (int)$_POST['hobbiesList']]
    );
}

redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
