<?php
function profilePage()
{
    global $target_dir_img;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    if (isset($_GET['user_id']) && $_GET['user_id'] !== $user_id || $_SESSION[SESSION_KEY_ADMIN] === 0) {
        redirect('/profile');
    }

    if (isset($_POST['edituser'])) {
        customStatement(
            'UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE users_id = :user_id',
            [':user_id' => $user_id, ':first_name' => $_POST['first_name'], ':last_name' => $_POST['last_name'], ':email' => $_POST['email']]
        );
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
            if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $target_file)) {
                $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
            }
        }
    }
    ?>
    <contentsection>
        <h1> Edit Profile</h1>
        <form method="post" enctype="multipart/form-data" class="setprofilepicture">
            <images>
                <img src="/views/public/images/<?= $profileimg ?>" />
                <span class="material-symbols-rounded"> </span>
                <img src="/views/public/images/<?= $profileimg ?>" name="newProfileImg" />
            </images>
            <label for="imgToUpload" class="uploadImage">
                <!-- hidden file input that gets replaced by the span -->
                <input type="file" name="imgToUpload" id="imgToUpload" accept="image/*" />
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
            <label for="description">Description / Biography:</label>
            <textarea name="description" id="" rows="4" name="description" placeholder="Empty description"><?= getUserInfo()["description"] ?></textarea>
            <input type="submit" value="Submit" name="edituser">
        </form>
    </contentsection>
    <?php
}
function hobbiesPage()
{
    $hobbies = customStatement("SELECT * FROM hobbies");
?>
    <contentsection>
        <h1>Add Hobbies</h1>
        <!-- hobby selector -->
        <form method="post" id="hobbies">
            <select name="hobbies" id="hobbySelection">
                <option value="0" name='default' selected disabled>Select a hobby</option>
                <?php
                foreach ($hobbies as $hobby) {
                    echo "<option value='" . $hobby['hobbies_id'] . "' name='selected_hobby'>" . $hobby['hobby_name'] . "</option>";
                }
                ?>
                <option value="create_new_hobby">Create new hobby</option>
            </select>
            <input type="submit" value="Add hobby" name="add_hobby_to_profile">
        </form>
        <!-- upload image to hobby -->
        <form method="post" class="uploadImage">
            <label for="imgToUpload">
                <!-- hidden file input that gets replaced by the span -->
                <input type="file" name="imgToUpload" id="imgToUpload" accept="image/*" />
                <span>Select Image
                    <span class="material-symbols-rounded">
                        add_photo_alternate
                    </span>
                </span>
            </label>
            <input type="submit" name="uploadImgSubmit" />
        </form>
        <!-- create new hobby -->
        <form method="post" id="createHobbyForm" style="display: none;">
            <input type="text" placeholder="Enter new hobby name" name="create_hobby_name">
            <input type="submit" value="Create hobby" name="create_hobby">
        </form>

        <hobbygrid>
            <!-- display the hobbies that the user has selected -->
            <hobbyarticle>
                <img src="" alt="">
            </hobbyarticle>
        </hobbygrid>
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
    }
}

$user_id = $_SESSION[SESSION_KEY_USER_ID];

// check if profile picture exists
if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
    $profileimg = "profile_picture_" . $user_id . ".jpg";
} else {
    $profileimg = "default.png";
}

// check the forms and do sql querys
if (isset($_POST['edituser'])) {
    customStatement("UPDATE users SET first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', email= '" . $_POST['email'] . "' WHERE users_id = :user_id", [':user_id' => $user_id]);
} else if (isset($_POST["add_hobby_to_profile"])) {
    $hobby_id = (int)$_POST['hobbies'];
    $stmt = $conn->prepare("SELECT * FROM user_hobbies WHERE users_id = :user_id AND hobbies_id = :hobby_id");
    $stmt->execute([':user_id' => $user_id, ':hobby_id' => $hobby_id]);
    if (!$stmt->fetch()) {
        if (!empty($stmt->fetchAll())) {
            customStatement("INSERT IGNORE INTO user_hobbies (users_id, hobbies_id) VALUES (:user_id, :hobby_id)", [':user_id' => $user_id, ':hobby_id' => $hobby_id]);
        }
    }
} else if (isset($_POST["create_hobby"])) {
    customStatement("INSERT IGNORE INTO hobbies (hobby_name) VALUE (:hobby_name)", [':hobby_name' => ucfirst($_POST['create_hobby_name'])]);
} else if (isset($_POST['uploadpfp'])) {
    $target_file = $target_dir_img . "profile_picture_" . $user_id . ".jpg";
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $extensions_arr = array("jpg", "jpeg", "png", "gif");

    if (in_array($imageFileType, $extensions_arr)) {
        if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
        }
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
