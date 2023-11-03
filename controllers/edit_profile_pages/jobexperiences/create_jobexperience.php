<?php

global /** @var PDO $conn */
$conn, $targetDirImage, $getHobbies, $hobbyimg, $userHobbies;
if (isset($_POST['create_jobexperience']) && !empty($_FILES['imgToUpload']['name'])) {
    $targetFile = $targetDirImage . "job_" . str_replace(' ', '_', strtolower($_POST['create_jobexperience_name'])) . ".jpg";
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $extensionsArr = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $extensionsArr, true)) {
        $succeeded = move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $targetFile);
        if ($succeeded === false) {
            throw new Error('File uploading did not succeed');
        }
    }
}

try {
    $conn->beginTransaction();
    // maak hobby aan en zet het in de rij van de hobbies die je kan selecteren
    customStatement('INSERT INTO jobexperiences (company_name, job_title) VALUE (:company_name, :job_title)',
        [':company_name' => ucfirst($_POST['create_jobexperience_name']), ':job_title' => 'Rocket turrent engineer']
    );
    $jobexperiences = customStatement('SELECT * FROM jobexperiences ORDER BY jobexperiences_id DESC LIMIT 1');
    customStatement('INSERT INTO user_jobexperiences (users_id, jobexperiences_id) VALUE (:user_id, :jobexperiences_id)', [':user_id' => $user_id, ':jobexperiences_id' => $jobexperience['jobexperiences_id']]);
    $conn->commit();
} catch (PDOException $exception) {
    $conn->rollBack();
    die (var_dump($exception));
}

redirect('/editprofile?tab=jobs&user_id=' . $user_id);