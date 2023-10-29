<?php
function aboutPage()
{
 


?>
    <contentsection>
        <p>
            <?= getUserInfo ()['description'] ?>
        </p>
    </contentsection>
<?php
}






function getUserInfo()
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE users_id = :user_id");
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
    }
}



if (file_exists($target_dir_img . "profile_picture_" . $_SESSION['user_id'] . ".jpg")) {
    $profileimg = "profile_picture_" . $_SESSION['user_id'] . ".jpg";
} else {
    $profileimg = "default.png";
}
require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
