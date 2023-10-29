<?php
function profilePage()
{
    global $target_dir_img;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    if (isset($_POST['edituser'])) {
        customStatement("UPDATE users SET first_name = '" . $_POST['first_name'] . "', last_name = '" . $_POST['last_name'] . "', email= '" . $_POST['email'] . "', description = '" . $_POST['description'] . "' WHERE users_id = :user_id", [':user_id' => $user_id]);
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
            <img src="/views/public/images/<?= $profileimg ?>" />
            <label for="fileToUpload">
                <!-- hidden file input that gets replaced by the span -->
                <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" />
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
        <form action="" method="post" id="hobbies">
            <select name="hobbies" id="hobbySelection">
                <option value="0" name='default' selected disabled>Select a hobby</option>
                <?php
                foreach ($hobbies as $hobby) {
                    echo "<option value='" . $hobby['hobbies_id'] . "' name='selected_hobby'>" . $hobby['hobby_name'] . "</option>";
                }
                ?>
                <option value="create_new_hobby">Create new hobby</option>
            </select>
            <input type="submit" value="Add hobby" name="add_hobby_to_profile" disabled></input>
        </form>
        <form action="" method="post" id="createHobbyForm" style="display: none;">
            <input type="text" placeholder="Enter new hobby name" name="create_hobby_name">
            <input type="submit" value="Create hobby" name="create_hobby">
        </form>
    </contentsection>
    <script>
        let hobbiesSelect = document.getElementById('hobbySelection');
        let createHobbySection = document.getElementById('createHobbyForm');
        let addHobbyButton = document.querySelector("input[name='add_hobby_to_profile']");
        let createHobbyButton = document.querySelector("input[name='create_hobby']");
        hobbiesSelect.addEventListener('change', () => {
            if (hobbiesSelect.value === "0") {
                addHobbyButton.disabled = true;
            } else if (hobbiesSelect.value === 'create_new_hobby') {
                createHobbySection.style.display = 'flex';
                addHobbyButton.style.display = 'none';
            } else {
                createHobbySection.style.display = 'none';
                addHobbyButton.style.display = 'flex';
                addHobbyButton.disabled = false;
            }
        });
    </script>
<?php
}
function getUserInfo()
{
    global $conn;
    $user_id = $_SESSION[SESSION_KEY_USER_ID];
    $stmt = $conn->prepare("SELECT * FROM users WHERE users_id = :user_id");
    $stmt->execute([':user_id' => $user_id]);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user_info) {
        return $user_info;
    } else {
        // handle the case where no rows are returned by the SQL statement
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
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file)) {
            $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
        }
    }
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
