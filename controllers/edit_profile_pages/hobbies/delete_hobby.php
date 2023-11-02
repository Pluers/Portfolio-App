<?php
if (isset($_POST['delete_hobby'])) {
    $hobbies = customStatement('SELECT hobby_name FROM hobbies WHERE hobbies_id = :hobbies_id', [':hobbies_id' => (int)$_POST['hobbiesList']]);
    foreach ($hobbies as $hobby) {
        // Delete de hobby
        customStatement('DELETE FROM hobbies WHERE hobbies_id = :hobbies_id', [':hobbies_id' => (int)$_POST['hobbiesList']]);

        $filePath = '/views/public/images/hobby_' . $hobby['hobby_name'] . '.jpg';
        // Delete de image
        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $filePath)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $filePath);
        }
    };
}

redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
