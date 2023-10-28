<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<section>
    <div>
        <img src="/views/public/images/<?= $profileimg ?>">
        <h1> <?= getUserInfo()['first_name'] . " " . getUserInfo()['last_name'] ?></h1>
    </div>
    <button id="EditProfile" onclick="window.location.href='/edit';">Edit Profile</button>
</section>
<hr>
<h1 id="aboutme">About me</h1>
<section>
    <article>
        <img src="" alt="" class="squaretwo">
        <p>Lorem ipsum dolor sit amet. Qui exercitationem consectetur qui expedita tempora qui consequatur
            odio
            vel quia illum et necessitatibus fuga ut autem aperiam.

            necessitatibus aut consectetur repellendus.
        </p>
    </article>
    <article>
        <img src="" alt="" class="squaretwo">
        <p>Lorem ipsum dolor sit amet. Qui exercitationem consectetur qui expedita tempora qui consequatur
            odio
            vel quia illum et necessitatibus fuga ut autem aperiam.
        </p>
    </article>
</section>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>