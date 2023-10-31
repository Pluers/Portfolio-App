<?php

global $conn;

$hobby_id = (int)$_POST['hobbiesList'];

$stmt = $conn->prepare('SELECT * FROM user_hobbies WHERE users_id = :user_id AND hobbies_id = :hobby_id');
$stmt->execute([':user_id' => $user_id, ':hobby_id' => $hobby_id]);
// only insert unique combinations
if ($stmt->fetch() === false) {
    $result = customStatement('INSERT INTO user_hobbies (users_id, hobbies_id) VALUES (:user_id, :hobby_id)', [':user_id' => $user_id, ':hobby_id' => $hobby_id]);
    if ($result === false) {
        throw new Exception('Doet het niet noob');
        // er moet hier nog even een error message geplaatst worden.
    }
}

redirect('/editprofile?tab=hobbies&user_id='.$user_id);