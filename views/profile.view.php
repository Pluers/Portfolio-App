<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
// zet de default tab naar about
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'about';
?>
<section>
    <div>
        <img src="/views/public/images/<?= $profileImage ?>">
        <h1> <?= $user['first_name'] . " " . $user['last_name'] ?></h1>
    </div>
    <!-- voor url dat de $_GETs niet overlappen -->
    <?php if (isCurrentUserAllowedToEditUser()) {
        $extraParams = [];
        if (!empty($_GET['user_id'])) {
            $extraParams['user_id'] = $_GET['user_id'];
        }
        if (!empty($_GET['tab'])) {
            $extraParams['tab'] = $_GET['tab'];
        }
    ?>
        <!-- ontkoppel de hobby van profiel -->
        <form method="post">
            <input type="submit" onclick="return confirm('Are you sure you want to delete your profile? (This cannot be undone!');" value=" Delete account" name="deleteUser">
            <input type="button" onclick="window.location.href='/editprofile?<?= http_build_query($extraParams); ?>'" name="" value="Edit Profile">
        </form>
    <?php } ?>
</section>

<section>
    <!-- navbar voor de profile view, net als de editprofile -->
    <nav>
        <ul>
            <li>
                <a href="?user_id=<?= $user_id ?>&tab=about" <?= $active_tab === 'about' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        person_book
                    </span>
                    About
                </a>
            </li>
            <li>
                <a href="?user_id=<?= $user_id ?>&tab=hobbies" <?= $active_tab === 'hobbies' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        sports_and_outdoors
                    </span>
                    Hobbies
                </a>
            </li>
            <li>
                <a href="?user_id=<?= $user_id ?>&tab=jobs" <?= $active_tab === 'jobs' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        work
                    </span>
                    Job experiences
                </a>
            </li>
            <li>
                <a href="?user_id=<?= $user_id ?>&tab=educations" <?= $active_tab === 'educations' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        school
                    </span>
                    Educations
                </a>
            </li>
        </ul>
    </nav>

    <?php
    if ($active_tab === 'about') { ?>
        <contentsection>
            <p>
                <?= getUserInfo($user_id)['description'] ?>
            </p>
        </contentsection>
    <?php } elseif ($active_tab === 'hobbies') { ?>
        <contentsection>
            <hobbygrid>
                <!-- display the hobbies die de user geselecteerd heeft -->
                <?php foreach ($userHobbies as $userHobby) { ?>
                    <form method="post">
                        <input type="hidden" name="deleteHobbyUser" value="<?= $userHobby['hobby_name'] ?>">
                        <button type="button" style="background: none; border: none; padding: 0; margin: 0;" name="delete_hobby_user">
                            <hobbyarticle style="background-image: url('/views/public/images/hobby_<?= $userHobby['hobby_name'] ?>.jpg')">
                                <h2><?= $userHobby['hobby_name'] ?></h2>
                                <p><?= $userHobby['hobby_description'] ?></p>
                            </hobbyarticle>
                        </button>
                    </form>
                <?php } ?>
            </hobbygrid>
        </contentsection>
    <?php } elseif ($active_tab === 'jobs') { ?>
        <contentsection>
            <hobbygrid>
                <!-- display the jobs die de user geselecteerd heeft -->
                <?php foreach ($userJobexperiences as $userJobexperience) { ?>
                    <form method="post">
                        <input type="hidden" name="deleteHobbyUser" value="<?= $userJobexperience['company_name'] ?>">
                        <button type="button" style="background: none; border: none; padding: 0; margin: 0;" name="delete_hobby_user">
                            <hobbyarticle style="background-image: url('/views/public/images/job_<?= str_replace(' ', '_', $userJobexperience['company_name']) ?>.jpg')">
                                <h2><?= $userJobexperience['company_name'] ?></h2>
                                <p><?= $userJobexperience['job_title'] ?></p>
                            </hobbyarticle>
                        </button>
                    </form>
                <?php } ?>
            </hobbygrid>
        </contentsection>
    <?php
    } elseif ($active_tab === 'educations') {
        // hier hadden wij helaas geen tijd meer voor
    }
    ?>
</section>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>