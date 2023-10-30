<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'about';
?>
<section>
    <div>
        <img src="/views/public/images/<?= $profileimg ?>">
        <h1> <?= $user['first_name'] . " " . $user['last_name'] ?></h1>
    </div>
    <input type="button" onclick="window.location.href='/editprofile';" name="" value="Edit Profile">
</section>

<section>
    <nav>
        <ul>

            <li>
                <a href="?tab=about" <?php echo $active_tab === 'about' ? 'class="active"' : ''; ?>>
                    <span class="material-symbols-rounded">
                        person_book
                    </span>
                    About
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
    if ($active_tab === 'about') {
        aboutPage();
    } elseif ($active_tab === 'hobbies') {
        hobbiesPage();
    } elseif ($active_tab === 'jobs') {
    } elseif ($active_tab === 'educations') {
    }
    ?>
</section>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>