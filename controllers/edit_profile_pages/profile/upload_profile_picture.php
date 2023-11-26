<?php

$targetFile = $targetDirImage . "profile_picture_" . $user_id . ".jpg";
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
$extensions_arr = array("jpg", "jpeg", "png", "gif");

if (in_array($imageFileType, $extensions_arr, true)) {
    move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $targetFile);
}

redirect('/editprofile?tab=profile&user_id=' . $user_id);
