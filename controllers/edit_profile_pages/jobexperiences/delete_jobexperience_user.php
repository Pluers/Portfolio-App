<?php

customStatement(
    'DELETE FROM user_jobexperiences
        WHERE jobexperiences_id = :jobexperiences_id 
        AND users_id = :user_id',
    [
        ':jobexperiences_id' => (int) $_POST['jobexperience_id'],
        ':user_id' => $user_id
    ]
);


redirect('/editprofile?tab=jobs&user_id=' . $user_id);
