<?php
function profilePage()
{
    global $target_dir_img;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    if (isset($_GET['user_id']) && $_GET['user_id'] !== $user_id || $_SESSION[SESSION_KEY_ADMIN] === 0) {
        redirect('/profile');
    }

    if (isset($_POST['edituser'])) {
        customStatement('UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE users_id = :user_id',
            [':user_id' => $user_id, ':first_name' => $_POST['first_name'], ':last_name' => $_POST['last_name'], ':email' => $_POST['email']]);
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
    ?>
    <contentsection>
        <h1> Edit Profile</h1>
        <form method="post" enctype="multipart/form-data" class="setprofilepicture">
            <img src="/views/public/images/<?= $profileimg ?>"/>
            <label for="fileToUpload">
                <!-- hidden file input that gets replaced by the span -->
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*"/>
                <span>Select Image
                    <span class="material-symbols-rounded">
                        add_photo_alternate
                    </span>
                </span>
            </label>
            <input type="submit" value="Upload" name="uploadpfp">
        </form>
        <form method="post" class="editprofile">
            <label for="first_name">First name:</label>
            <input type="text" placeholder="First Name" name="first_name" value="<?= getUserInfo()["first_name"] ?>">
            <label for="last_name">Last name:</label>
            <input type="text" placeholder="Last Name" name="last_name" value="<?= getUserInfo()["last_name"] ?>">
            <label for="email">Email:</label>
            <input type="text" Placeholder="Email" name="email" value="<?= getUserInfo()["email"] ?>" required>
            <label for="change_password">Password: </label>
            <a href="/forgot" target="_blank">Change Password
                <span class="material-symbols-rounded">
                    open_in_new
                </span>
            </a>
            <input type="submit" value="Submit" name="edituser">
        </form>
    </contentsection>
    <?php
}

function aboutPage()
{
    ?>
    <contentsection>
        <p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus iusto obcaecati nobis possimus at ducimus
            sint, facere voluptatem iure, nam illum tempora assumenda hic. Voluptatum cum earum totam magni mollitia!
        </p>
    </contentsection>
    <?php
}

function hobbiesPage()
{
    ?>
    <contentsection>
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
    </contentsection>
    <?php
}

function getUserInfo()
{
    global $conn;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    $stmt = $conn->prepare('SELECT * FROM users WHERE users_id = :user_id');
    $stmt->execute([':user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
    }
}

$user_id = $_SESSION[SESSION_KEY_USER_ID];
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
