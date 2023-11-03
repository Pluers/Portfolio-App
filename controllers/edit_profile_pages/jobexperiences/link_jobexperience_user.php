<?php

global $conn;

$jobexperience_id = (int) $_POST['jobexperience_id'];
// haalt alles op uit de user_jobexperiences tabel.
$stmt = $conn->prepare('SELECT * FROM user_jobexperiences WHERE users_id = :users_id AND jobexperiences_id = :jobexperiences_id');
$stmt->execute([':users_id' => $user_id, 'jobexperiences_id' => $jobexperience_id]);
// gaat alleen inserten als de combinatie van de user en de jobexperience uniek.
if ($stmt->fetch() === false) {
    $result = customStatement('INSERT INTO user_jobexperiences (users_id, jobexperiences_id) VALUES (:users_id, :jobexperiences_id)', [':users_id' => $user_id, ':jobexperiences_id' => $jobexperience_id]);
    if ($result === false) {
        throw new Exception('Kon de jobexperience niet linken met jouw profiel, probeer het later nog een keer of neem contact op met de eigenaar van de website');
    }
}

redirect('/editprofile?tab=jobs&user_id='.$user_id);