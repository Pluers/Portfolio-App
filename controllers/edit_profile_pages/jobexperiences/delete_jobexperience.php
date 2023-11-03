<?php

customStatement(
    'DELETE FROM jobexperiences 
        WHERE jobexperiences_id = :jobexperiences_id',
    [':jobexperiences_id' => (int) $_POST['jobexperience_id']]
);


redirect('/editprofile?tab=jobs&user_id=' . $user_id);