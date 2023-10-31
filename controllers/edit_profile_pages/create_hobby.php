<?php

global $targetDirImage, $getHobbies, $hobbyimg, $hobbyName, $userHobbies;

if (isset($_POST['create_hobby']) && !empty($_POST['imgToUpload'])) {
    $targetFile = $targetDirImage . "hobby_" . $hobbyName . ".jpg";
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
    $extensionsArr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensionsArr, true)) {
        $succeeded = move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $targetFile);
        if ($succeeded === false) {
            throw new Error('File uploading did not succeed');
        }
    }
}
// TODO: maak controle of al deze waardes wel bestaan.

// maak hobby aan en zet het in de rij van de hobbies die je kan selecteren
customStatement('INSERT INTO hobbies (hobby_name) VALUE (:hobby_name)', [':hobby_name' => ucfirst($_POST['create_hobby_name'])]);

redirect('/editprofile?tab=hobbies');