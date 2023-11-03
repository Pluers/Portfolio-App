<?php

global /** @var PDO $conn */
$conn,$targetDirImage, $getHobbies, $hobbyimg, $userHobbies;

/** hier wordt ervoor gezorgd dat de images die bij de hobby worden meegegeven op worden geslagen als hobby_"hobbynaam"
 * de filename wordt automatisch geregeld door de str_replace, die zorgt ervoor dat de spatie wordt vervangen met "_".
 * er wordt ook nog gekeken naar wat voor soort file het is. als het file type overeenkomt met de array mag hij geupload worden.
*/
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
}


try {
    $conn->beginTransaction();
    // maakt hobby aan en zet het in de rij van de hobbies die je kan selecteren
    customStatement('INSERT INTO hobbies (hobby_name, hobby_description) VALUE (:hobby_name, :hobby_desc)', [':hobby_name' => ucfirst($_POST['create_hobby_name']), ':hobby_desc' => ucfirst($_POST['create_hobby_description'])]);
    $hobby = customStatement('SELECT * FROM hobbies ORDER BY hobbies_id DESC LIMIT 1')[0];
    customStatement('INSERT INTO user_hobbies (users_id, hobbies_id) VALUE (:user_id, :hobbies_id)', [':hobbies_id' => $hobby['hobbies_id'], ':user_id' => $user_id]);
    $conn->commit();
} catch (PDOException $exception) {
    $conn->rollBack();
}


redirect('/editprofile?tab=hobbies&user_id=' . $user_id);
