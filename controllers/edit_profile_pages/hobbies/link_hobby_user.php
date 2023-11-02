<?php

global $conn;

$hobby_id = (int)$_POST['hobbiesList'];
// haalt alles op uit de user_hobbies tabel.
$stmt = $conn->prepare('SELECT * FROM user_hobbies WHERE users_id = :user_id AND hobbies_id = :hobby_id');
$stmt->execute([':user_id' => $user_id, ':hobby_id' => $hobby_id]);
// gaat alleen inserten als de combinatie van de user en de hobby uniek.
if ($stmt->fetch() === false) {
    $result = customStatement('INSERT INTO user_hobbies (users_id, hobbies_id) VALUES (:user_id, :hobby_id)', [':user_id' => $user_id, ':hobby_id' => $hobby_id]);
    if ($result === false) {
        throw new Exception('Kon de hobby niet linken met jouw profiel, probeer het later nog een keer of neem contact op met de eigenaar van de website');
        // er moet hier nog even een error message geplaatst worden.
    }
}

redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
