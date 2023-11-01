<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
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
        <input type="button" onclick="window.location.href='/editprofile?<?= http_build_query($extraParams); ?>'" name="" value="Edit Profile">
    <?php } ?>
</section>

<section>
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
    // print de html voor de pagina met de naam van de tab
    if ($active_tab === 'about') { ?>
        <contentsection>
            <p>
                <?= getUserInfo($user_id)['description'] ?>
            </p>
        </contentsection>
    <?php } elseif ($active_tab === 'hobbies') { ?>
        <contentsection>
            <p>
                <?php
                $result = customStatement('SELECT hobbies.hobby_name FROM user_hobbies JOIN hobbies ON user_hobbies.hobbies_id = hobbies.hobbies_id WHERE users_id = :users_id', [':users_id' => $user_id]);
                if ($result !== false) {
                    foreach ($result as $key) {
                        echo $key['hobby_name'] . "<br>";
                    }
                } else {
                    echo "No hobbies found.";
                }
                ?>
            </p>
        </contentsection>
    <?php } elseif ($active_tab === 'jobs') {
    } elseif ($active_tab === 'educations') {
    }
    ?>
</section>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>