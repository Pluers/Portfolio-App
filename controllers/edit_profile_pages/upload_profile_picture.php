<?php

$targetFile = $targetDirImage . "profile_picture_" . $user_id . ".jpg";
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$extensions_arr = array("jpg", "jpeg", "png", "gif");

if (in_array($imageFileType, $extensions_arr, true)) {
    if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $targetFile)) {
        $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
    }
}

redirect('/editprofile?tab=profile');
