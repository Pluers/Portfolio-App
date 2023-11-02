<?php

global $conn;

$hobby_id = (int)$_POST['hobbiesList'];
// haalt alles op uit de user_hobbies tabel.
$stmt = $conn->prepare('SELECT * FROM user_jobexperiences WHERE users_id = :users_id AND jobexperiences_id = :jobexperiences_id');
$stmt->execute([':uses_id' => $user_id, ':hobby_id' => $hobby_id]);
// gaat alleen inserten als de combinatie van de user en de hobby uniek.
if ($stmt->fetch() === false) {
    $result = customStatement('INSERT INTO user_jobexperiences (users_id, jobexperiences_id) VALUES (:users_id, :jobexperiences_id)', [':users_id' => $user_id, ':hobby_id' => $hobby_id]);
    if ($result === false) {
        throw new Exception('Doet het niet');
        // er moet hier nog even een error message geplaatst worden.
    }
}

redirect('/editprofile?tab=hobbies&user_id='.$user_id);