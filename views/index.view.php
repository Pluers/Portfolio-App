<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>

<link rel="stylesheet" href="/views/public/styles/homepage.css">
<section>
    <?php
    foreach ($users as $user) {
    ?>
        <article>
            <img class='square'>
            <profile>
                <img src=<?= file_exists($target_dir_img . "profile_picture_" . $user['users_id'] . ".jpg") ? "/views/public/images/profile_picture_" . $user['users_id'] . ".jpg" : "/views/public/images/default.png" ?>>
                <p>
                    <?= $devmode ? (!empty($user['username']) ? "username: " . $user['username'] . " | " : "") . $user['first_name'] . " " . $user['last_name'] . " <b>isAdmin: " . $user['isAdmin'] . "</b>" : $user['first_name'] . " " . $user['last_name']; ?>
                </p>
                <br>
            </profile>
        </article>
    <?php
    }
    ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>