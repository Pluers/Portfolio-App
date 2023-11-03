<?php

global $conn;

$hobby_id = (int)$_POST['hobbiesList'];
// haalt alles op uit de user_hobbies tabel.
$stmt = $conn->prepare('SELECT * FROM user_hobbies WHERE users_id = :users_id AND hobbies_id = :hobby_id');
$stmt->execute([':users_id' => $user_id, ':hobby_id' => $hobby_id]);
// gaat alleen inserten als de combinatie van de user en de hobby uniek.
if ($stmt->fetch() === false) {
    $result = customStatement('INSERT INTO user_hobbies (users_id, hobbies_id) VALUES (:users_id, :hobby_id)', [':users_id' => $user_id, ':hobby_id' => $hobby_id]);
    if ($result === false) {
        throw new Exception('Doet het niet');
        // er moet hier nog even een error message geplaatst worden.
    }
}

redirect('/editprofile?tab=hobbies&user_id='.$user_id);