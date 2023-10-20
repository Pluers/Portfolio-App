<link rel="stylesheet" href="/views/styles/homepage.css">
<section>
    <?php
    $users = sqlStatement("SELECT users.username, users.isAdmin FROM users");
    foreach ($users as $user) {
        echo
        "<article><img class='square'><profile><img class='circle'><p>" . $user['username'] . " " . $user['isAdmin'] . "</p><br></article>";
    }
    ?>
</section>