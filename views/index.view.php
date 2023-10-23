<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>

<link rel="stylesheet" href="/views/public/styles/homepage.css">
<section>
    <?php
    /** @var array $users */
    foreach ($users as $user) { ?>
        <article>
            <div class='square'>
                <profile>
                    <div class='circle'>
                        <p>
                            <?= $user['username'] . " " . $user['isAdmin']; ?>
                        </p>
                        <br>
                    </div>
                </profile>
            </div>
        </article>
    <?php } ?>
</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>