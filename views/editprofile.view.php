<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<!-- input fields and edit buttons for all categories below -->

<section>

    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'profile';
    ?>
    <nav>
        <ul>
            <li>
                <a href="?tab=profile" <?php echo $active_tab === 'profile' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        manage_accounts
                    </span>
                    Profile
                </a>
            </li>
            <li>
                <a href="?tab=hobbies" <?php echo $active_tab === 'hobbies' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        sports_and_outdoors
                    </span>
                    Hobbies
                </a>
            </li>
            <li>
                <a href="?tab=jobs" <?php echo $active_tab === 'jobs' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        work
                    </span>
                    Job experiences
                </a>
            </li>
            <li>
                <a href="?tab=educations" <?php echo $active_tab === 'educations' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        school
                    </span>
                    Educations
                </a>
            </li>
        </ul>
    </nav>
    <?php
    if ($active_tab === 'profile') {
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
    } elseif ($active_tab === 'hobbies') {
    ?>
        <contentsection>
            <h1>Add Hobbies</h1>
            <!-- hobby selector -->
            <form method="post" id="hobbiesForm">
                <select name="hobbiesList" id="hobbySelection">
                    <option value="0" name='default' selected disabled>Select a hobby</option>
                    <?php
                    foreach ($gethobbies as $hobby) {
                        echo "<option value='" . $hobby['hobbies_id'] . "' name='selected_hobby'>" . $hobby['hobby_name'] . "</option>";
                    }
                    ?>
                    <option value="create_new_hobby">Create new hobby</option>
                </select>
                <input type="submit" value="Add hobby" name="add_hobby_to_profile">
            </form>

            <!-- create new hobby -->
            <form method="post" id="createHobbyForm" enctype="multipart/form-data" style="display: none;">
                <label for="imgToUpload" class="uploadImage">
                    <!-- hidden file input that gets replaced by the span -->
                    <input type="file" name="imgToUpload" id="imgToUpload" accept="image/*" />
                    <span>Select Image
                        <span class="material-symbols-rounded">
                            add_photo_alternate
                        </span>
                    </span>
                </label>
                <!-- input text -->
                <input type="text" placeholder="Enter new hobby name" name="create_hobby_name">
                <input type="submit" value="Create hobby" name="create_hobby">
            </form>

            <hobbygrid>
                <!-- display the hobbies that the user has selected -->
                <?php
                $printed_hobbies = [];

                foreach ($user_hobbies as $user_hobby) {
                    if (!in_array($user_hobby['hobby_name'], $printed_hobbies)) {
                ?>
                        <hobbyarticle>
                            <img src="/views/public/images/hobby_<?= $user_hobby['hobby_name'] ?>.jpg" alt="">
                            <p><?= $user_hobby['hobby_name'] ?></p>
                        </hobbyarticle>
                <?php
                        // Add this hobby to the printed hobbies array
                        $printed_hobbies[] = $user_hobby['hobby_name'];
                    }
                }
                ?>

            </hobbygrid>
        </contentsection>
    <?php
    } elseif ($active_tab === 'jobs') {
    } elseif ($active_tab === 'educations') {
    }
    ?>


</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>