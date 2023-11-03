<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<!-- input fields and edit buttons for all categories below -->

<section>

    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'profile';
    $extraParams = [];
    if (!empty($_GET['user_id'])) {
        $extraParams['user_id'] = $_GET['user_id'];
    }
    ?>
    <nav>
        <ul>
            <li>
                <a href="?<?= http_build_query(array_merge(['tab' => 'profile'], $extraParams)); ?>" <?php echo $active_tab === 'profile' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        manage_accounts
                    </span>
                    Profile
                </a>
            </li>
            <li>
                <a href="?<?= http_build_query(array_merge(['tab' => 'hobbies'], $extraParams)); ?>" <?= $active_tab === 'hobbies' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        sports_and_outdoors
                    </span>
                    Hobbies
                </a>
            </li>
            <li>
                <a href="?<?= http_build_query(array_merge(['tab' => 'jobs'], $extraParams)); ?>" <?php echo $active_tab === 'jobs' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        work
                    </span>
                    Job experiences
                </a>
            </li>
            <li>
                <a href="?<?= http_build_query(array_merge(['tab' => 'educations'], $extraParams)); ?>" <?php echo $active_tab === 'educations' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        school
                    </span>
                    Educations
                </a>
            </li>
        </ul>
    </nav>
    <?php if ($active_tab === 'profile') { ?>
        <contentsection>
            <h1> Edit Profile</h1>
            <form method="post" enctype="multipart/form-data" class="setprofilepicture">
                <images>
                    <img src="/views/public/images/<?= $profileImage ?>" />
                    <span class="material-symbols-rounded"> </span>
                    <img src="/views/public/images/<?= $profileImage ?>" name="newProfileImg" />
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
                <input type="text" placeholder="First Name" name="first_name" value="<?= $user["first_name"] ?>" required />
                <label for="last_name">Last name:</label>
                <input type="text" placeholder="Last Name" name="last_name" value="<?= $user["last_name"] ?>" required />
                <label for="email">Email:</label>
                <input type="text" Placeholder="Email" name="email" value="<?= $user["email"] ?>" required />
                <label for="change_password">Password: </label>
                <a href="/forgot" target="_blank">Change Password
                    <span class="material-symbols-rounded">
                        open_in_new
                    </span>
                </a>
                <label for="description">Description / Biography:</label>
                <textarea name="description" id="" rows="4" name="description" placeholder="Empty description"><?= $user["description"] ?></textarea>
                <input type="submit" value="Submit" name="edituser">
            </form>
        </contentsection>

    <?php } else if ($active_tab === 'hobbies') { ?>
        <contentsection>
            <h1>Add Hobbies</h1>
            <!-- hobby selector -->
            <form method="post" id="hobbiesForm">
                <select name="hobbiesList" id="hobbySelection">
                    <option value="0" name='default' selected disabled>Select a hobby</option>
                    <?php
                    foreach ($getHobbies as $hobby) {
                        if (!in_array($hobby['hobbies_id'], array_column($userHobbies, 'hobbies_id'))) {
                            echo "<option value='" . $hobby['hobbies_id'] . "' name='selected_hobby'>" . $hobby['hobby_name'] . "</option>";
                        }
                    }
                    ?>
                    <option value="create_new_hobby">Create new hobby</option>
                </select>
                <label for="delete_hobby" class="uploadImage">
                    <input type="submit" value="Delete Hobby" name="delete_hobby" onclick="return confirm('Are you sure you want to delete this hobby?')" style="display: none;">
                    <span class="material-symbols-rounded" onclick="document.querySelector('input[name=delete_hobby]').click();">
                        delete
                    </span>
                </label>
                <input type="submit" value="Add hobby" name="add_hobby_to_profile">
            </form>

            <!-- create new hobby -->
            <form method="post" id="createHobbyForm" enctype="multipart/form-data" style="display: none;">
                <label for="imgToUpload" class="uploadImage">
                    <!-- hidden file input that gets replaced by the span -->
                    <input type="file" name="imgToUpload" id="imgToUpload" accept="image/*" required />
                    <span>Select Image
                        <span class="material-symbols-rounded">
                            add_photo_alternate
                        </span>
                    </span>
                </label>
                <!-- input text -->
                <input type="text" placeholder="Enter new hobby name" name="create_hobby_name" required>
                <textarea id="" rows="4" name="create_hobby_description" placeholder="Empty description (You cannot change this after the hobby is uploaded)" required></textarea>
                <input type="submit" value="Create hobby" name="create_hobby">
            </form>

            <hobbygrid>
                <!-- display the hobbies that the user has selected -->
                <?php foreach ($userHobbies as $userHobby) { ?>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this hobby from your profile?');">
                        <input type="hidden" name="deleteHobbyUser" value="<?= $userHobby['hobby_name'] ?>">
                        <button type="submit" style="background: none; border: none; padding: 0; margin: 0;" name="delete_hobby_user">
                            <hobbyarticle style="background-image: url('/views/public/images/hobby_<?= str_replace(' ', '_', $userHobby['hobby_name']) ?>.jpg')">
                                <h2><?= $userHobby['hobby_name'] ?></h2>
                                <p><?= $userHobby['hobby_description'] ?></p>
                            </hobbyarticle>
                        </button>
                    </form>
                <?php } ?>
            </hobbygrid>
        </contentsection>

    <?php } else if ($active_tab === 'jobs') { ?>
    <contentsection>
        <h1>Add jobexperiences</h1>
        <!-- hobby selector -->
        <form method="post" id="jobexperiencesForm">
            <select name="jobexperience_id" id="jobexperienceSelection">
                <option value="0" name='default' selected disabled>Select a jobexperience</option>
                <?php
                foreach ($getJobexperiences as $jobexperience) {
                    if (!in_array($jobexperience['jobexperiences_id'], array_column($userJobexperiences, 'jobexperiences_id'))) {
                        echo "<option value='" . $jobexperience['jobexperiences_id'] . "' name='selected_jobexperience'>" . $jobexperience['company_name'] . "</option>";
                    }
                }
                ?>
                <option value="create_new_jobexperience">Create new jobexperience</option>
            </select>
            <label for="delete_jobexperience" class="uploadImage">
                <input type="submit" value="Delete jobexperience" name="delete_jobexperience" onclick="return confirm('Are you sure you want to delete this jobexperience?')" style="display: none;">
                <span class="material-symbols-rounded" onclick="document.querySelector('input[name=delete_jobexperience]').click();">
                    delete
                </span>
            </label>
            <input type="submit" value="Add jobexperience" name="add_jobexperience_to_profile">
        </form>

        <!-- create new job experience -->
        <form method="post" id="createJobexperienceForm" enctype="multipart/form-data" style="display: none;">
            <label for="imgToUpload" class="uploadImage">
                <!-- hidden file input that gets replaced by the span -->
                <input type="file" name="imgToUpload" id="imgToUpload" accept="image/*"/>
                <span>Select Image
                        <span class="material-symbols-rounded">
                            add_photo_alternate
                        </span>
                    </span>
            </label>
            <!-- input text -->
            <input type="text" placeholder="Enter new jobexperience name" name="create_jobexperience_name" required>
            <input type="submit" value="Create jobexperience" name="create_jobexperience">
        </form>

        <jobexperiencegrid>
            <?php foreach ($userJobexperiences as $userJobexperience) { ?>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete this jobexperience from your profile?');">
                    <input type="hidden" name="jobexperience_id" value="<?= $userJobexperience['jobexperiences_id'] ?>">
                    <button type="submit" style="background: none; border: none; padding: 0; margin: 0;" name="delete_jobexperience_user">
                        <hobbyarticle style="background-image: url('/views/public/images/job_<?= str_replace(' ', '_', $userJobexperience['company_name']) ?>.jpg')">
                            <h2><?= $userJobexperience['company_name'] ?></h2>

                        </hobbyarticle>
                    </button>
                </form>
            <?php }?>
        </jobexperiencegrid>
    </contentsection>
    <?php } else if ($active_tab === 'educations')  ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>