<?php
global $conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

function aboutPage()
{
?>
    <contentsection>
        <p>
            <?= getUserInfo()['description'] ?>
        </p>
    </contentsection>
<?php
}
function hobbiesPage()
{
?>
    <contentsection>
        <p>
            <?php
            $result = customStatement('SELECT hobbies.hobby_name FROM user_hobbies JOIN hobbies ON user_hobbies.hobbies_id = hobbies.hobbies_id WHERE users_id = :users_id', [':users_id' => $_SESSION['user_id']]);
            if (is_array($result)) {
                foreach ($result as $key) {
                    echo $key['hobby_name'] . "<br>";
                }
            } else {
                echo "No hobbies found.";
            }

            ?>
        </p>
    </contentsection>
<?php
}

function getUserInfo()
{
    global $conn;
    $stmt = $conn->prepare('SELECT * FROM users WHERE users_id = :user_id');
    $stmt->execute([':user_id' => $_SESSION['user_id']]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
    }
}


if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
}

$sql = 'SELECT * FROM users WHERE users_id = :users_id';
$stmt = $conn->prepare($sql);
$stmt->bindParam(':users_id', $user_id);
$stmt->execute();
$user = $stmt->fetch();

if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/profile.view.php';
?>