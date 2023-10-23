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
                <img class='circle'>
                <p>
                    <?= $devmode ? $user['username'] . " <b>isAdmin: " . $user['isAdmin'] . "</b>" : $user['username']; ?>
                </p>
                <br>
            </profile>
        </article>
    <?php
    }
    ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>