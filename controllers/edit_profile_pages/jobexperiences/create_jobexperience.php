<?php

global /** @var PDO $conn */
$conn, $targetDirImage, $getHobbies, $hobbyimg, $userHobbies;

if (isset($_POST['create_jobexperience']) && !empty($_FILES['imgToUpload']['name'])) {
    $targetFile = $targetDirImage . "job_" . str_replace(' ', '_', strtolower($_POST['create_job_name'])) . ".jpg";
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
    customStatement('INSERT INTO jobexperiences (company_name) VALUE (:company_name)', [':company_name' => ucfirst($_POST['create_company_name'])]);
    $jobexperience = customStatement('SELECT * FROM jobexperiences ORDER BY jobexperiences_id DESC LIMIT 1')[0];
    customStatement('INSERT INTO user_jobexperiences (users_id, jobexperiences_id) VALUE (:user_id, :jobexperiences_id)', [':jobexperiences_id' => $jobexperience['jobexperiences_id'], ':user_id' => $user_id]);
    $conn->commit();
} catch (PDOException $exception) {
    $conn->rollBack();
}

redirect('/editprofile?tab=jobexperiences&user_id='.$user_id);