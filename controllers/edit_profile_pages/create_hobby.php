<?php

global
    /** @var PDO $conn */
    $conn, $targetDirImage, $getHobbies, $hobbyimg, $userHobbies;

if (isset($_POST['create_hobby']) && !empty($_FILES['imgToUpload']['name'])) {
    $targetFile = $targetDirImage . "hobby_" . str_replace(' ', '_', strtolower($_POST['create_hobby_name'])) . ".jpg";
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $extensionsArr = array("jpg", "jpeg", "png", "gif");
    if (in_array($imageFileType, $extensionsArr, true)) {
        $succeeded = move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $targetFile);
        if ($succeeded === false) {
            throw new Error('File uploading did not succeed');
        }
    }
} else if (isset($_POST['deleteHobbyUser'])) {
    $hobbyName = $_POST['deleteHobbyUser'];
    // var_dump();
    customStatement(
        'DELETE user_hobbies FROM user_hobbies 
                            JOIN hobbies ON user_hobbies.hobby_id = hobbies.id 
                            WHERE user_hobbies.users_id = :user_id AND hobbies.hobby_name = :hobby_name',
        [':user_id' => $user_id, ':hobby_name' => $hobbyName]
    );
} else if (isset($_POST['deleteHobby'])) {
    customStatement(
        'DELETE FROM hobbies WHERE hobbies_id = :hobbies_id',
        [':hobbies_id' => (int)$_POST['hobbiesList']]
    );
}

try {
    $conn->beginTransaction();
    // maak hobby aan en zet het in de rij van de hobbies die je kan selecteren
    customStatement('INSERT INTO hobbies (hobby_name, hobby_description) VALUE (:hobby_name, :hobby_desc)', [':hobby_name' => ucfirst($_POST['create_hobby_name']), ':hobby_desc' => ucfirst($_POST['create_hobby_description'])]);
    $hobby = customStatement('SELECT * FROM hobbies ORDER BY hobbies_id DESC LIMIT 1')[0];
    customStatement('INSERT INTO user_hobbies (users_id, hobbies_id) VALUE (:user_id, :hobbies_id)', [':hobbies_id' => $hobby['hobbies_id'], ':user_id' => $user_id]);
    $conn->commit();
} catch (PDOException $exception) {
    $conn->rollBack();
}


redirect('/editprofile?tab=hobbies&user_id=' . $user_id);