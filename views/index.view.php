<link rel="stylesheet" href="/views/public/styles/homepage.css">
<section>
    <?php
    foreach ($users as $user) {
        echo
        "<article><img class='square'><profile><img class='circle'><p>" . $user['username'] . " " . $user['isAdmin'] . "</p><br></article>";
    }
    ?>
</section>