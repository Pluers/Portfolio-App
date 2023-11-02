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
                            <hobbyarticle style="background-image: url('/views/public/images/hobby_<?= $userHobby['hobby_name'] ?>.jpg')">
                                <h2><?= $userHobby['hobby_name'] ?></h2>
                                <p><?= $userHobby['hobby_description'] ?></p>
                            </hobbyarticle>
                        </button>
                    </form>
                <?php } ?>
            </hobbygrid>
        </contentsection>

    <?php } else if ($active_tab === 'educations') { ?>
        <contentsection>
            <h1>Add Educations</h1>

            <!-- create new hobby -->
            <form method="post" id="createHobbyForm" enctype="multipart/form-data">
                <!-- input text -->
                <input type="text" placeholder="Enter education name" name="education_name" required>
                <select name="" id="" required>
                    <option value="" selected disabled>Select a degree</option>
                    <optgroup label="Primair onderwijs (po)">
                        <option value="suboption1">Regulier basisonderwijs</option>
                        <option value="suboption2">Speciaal basisonderwijs (sbo)</option>
                        <option value="suboption2">Speciaal onderwijs (so)</option>
                        <option value="suboption2">Voortgezet speciaal onderwijs (vso)</option>
                    </optgroup>
                    <optgroup label="Voortgezet onderwijs (vo)">
                        <option value="suboption1">Praktijkonderwijs (pro)</option>
                        <option value="suboption1">Vmbo Basisberoepsgerichte leerweg (vmbo-bb of vmbo-basis)</option>
                        <option value="suboption1">Vmbo Kaderberoepsgerichte leerweg (vmbo-kb of vmbo-kader)</option>
                        <option value="suboption1">Vmbo Gemengde leerweg (vmbo-g of vmbo-gl)</option>
                        <option value="suboption1">Vmbo Theoretische leerweg (vmbo-t of vmbo-tl)</option>
                        <option value="suboption1">Lwoo</option>
                        <option value="suboption1">Havo</option>
                        <option value="suboption1">Vwo</option>
                        <option value="suboption1">Tweetalig onderwijs (tto)</option>
                    </optgroup>
                    <optgroup label="Middelbaar beroepsonderwijs (mbo)">
                        <option value="suboption1">Mbo niveau 1</option>
                        <option value="suboption1">Mbo niveau 2</option>
                        <option value="suboption1">Mbo niveau 3</option>
                        <option value="suboption2">Mbo niveau 4</option>
                        <option value="suboption2">Vavo</option>
                    </optgroup>
                    <optgroup label="Hoger beroepsonderwijs (hbo)">
                        <option value="suboption1">Associate degree</option>
                        <option value="suboption2">Hbo-bachelor/professionele bachelor</option>
                        <option value="suboption2">Hbo-master/professionele master</option>
                    </optgroup>
                    <optgroup label="Wetenschappelijk onderwijs (wo)">
                        <option value="suboption1">Universitaire bachelor</option>
                        <option value="suboption2">Universitaire master</option>
                    </optgroup>
                    <option value="suboption2">PhD</option>
                </select>
                <input type="text" placeholder="Enter school name of the education" name="education_school_name" required>
                <label for="edu_start">start date</label>
                <input type="datetime-local" name="edu_start" id="edu_start" placeholder="start date">
                <label for="edu_end">end date</label>
                <input type="datetime-local" name="edu_end" id="edu_end" placeholder="end date">
                <label for="isGraduated">Has graduated</label>
                <input type="checkbox" name="isGraduated" id="isGraduated">
                <input type="submit" value="Create education" name="create_education">
            </form>

            <p style="text-align:center; color: red; font-weight: bold;">This form is not working yet</p>
            <hobbygrid>
                <!-- display the hobbies that the user has selected -->
                <?php foreach ($userHobbies as $userHobby) { ?>
                    <form method="post" onsubmit="return confirm('Are you sure you want to delete this hobby from your profile?');">
                        <input type="hidden" name="deleteHobbyUser" value="<?= $userHobby['hobby_name'] ?>">
                        <button type="submit" style="background: none; border: none; padding: 0; margin: 0;" name="delete_hobby_user">
                            <hobbyarticle style="background-image: url('/views/public/images/hobby_<?= $userHobby['hobby_name'] ?>.jpg')">
                                <h2><?= $userHobby['hobby_name'] ?></h2>
                                <p><?= $userHobby['hobby_description'] ?></p>
                            </hobbyarticle>
                        </button>
                    </form>
                <?php } ?>
            </hobbygrid>
        </contentsection>
    <?php } ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>