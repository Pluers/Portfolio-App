<?php
if (isset($_POST['delete_hobby'])) {
    customStatement(
        'DELETE FROM hobbies WHERE hobbies_id = :hobbies_id',
        [':hobbies_id' => (int)$_POST['hobbiesList']]
    );
}



redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
