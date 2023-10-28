<?php
function aboutPage()
{
?>
    <section>
        <form action="">
            <select name="hobbies" id="">
                <option value="hobby1">Hobby 1</option>
                <option value="hobby2">Hobby 2</option>
                <option value="hobby3">Hobby 3</option>
            </select>
            <input type="submit" value="Add Hobby"></input>
        </form>
        <form action="">
            <select name="job experiences" id="">
                <option value="job">Hobby 1</option>
                <option value="job">Hobby 2</option>
                <option value="job">Hobby 3</option>
            </select>
            <input type="submit" value="Add Hobby"></input>
        </form>
        <form action="">
            <select name="educations" id="">
                <option value="educations">Hobby 1</option>
                <option value="educations">Hobby 2</option>
                <option value="educations">Hobby 3</option>
            </select>
            <input type="submit" value="Add Hobby"></input>
        </form>
    </section>
<?php
}

function getUserInfo()
{
    global $conn;
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare("SELECT * FROM users WHERE users_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
    }
}

$_SESSION['user_id'] = 1;
$user_id = $_SESSION['user_id'];
if (isset($_POST['edituser'])) {
    customStatement("UPDATE users SET first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', email= '" . $_POST['email'] . "' WHERE users_id = :user_id", [':user_id' => $user_id]);
}
// check if profile picture exists
if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";
}
if (isset($_POST['uploadpfp'])) {
    $target_file = $target_dir_img . "profile_picture_" . $user_id . ".jpg";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
        }
    }
}






require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
