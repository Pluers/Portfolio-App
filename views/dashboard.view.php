<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>

<section>
    <?php
    foreach ($users as $user) {
    ?>
        <a href="/profile?user_id=<?= $user['users_id'] ?>">
            <article>
                <img src=<?= file_exists($targetDirImage . "profile_picture_" . $user['users_id'] . ".jpg") ? "/views/public/images/profile_picture_" . $user['users_id'] . ".jpg" : "/views/public/images/default.png" ?>>
                <div>
                    <h1>
                        <?= $devmode ? (!empty($user['username']) ? "username: " . $user['username'] . " | " : "") . $user['first_name'] . " " . $user['last_name'] . " <b>isAdmin: " . $user['isAdmin'] . "</b>" : $user['first_name'] . " " . $user['last_name']; ?>
                    </h1>
                    <p>
                        <!-- print bio of user -->
                        <?= $user['description']; ?>
                    </p>
                </div>

            </article>
        </a>
    <?php

    }
    ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>