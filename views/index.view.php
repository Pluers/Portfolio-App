<?php
require_once dirname(__FILE__, 2) . '/db.php';
?>
<section>
    <?php
    $users = sqlStatement($conn, "SELECT users.username, users.isAdmin FROM users");
    foreach ($users as $user) {
        echo
        "<article><img class='square'><profile><img class='circle'><p>" . $user['username'] . " " . $user['isAdmin'] . "</p><br></article>";
    }
    ?>

    <form action="hobby%update_hobby" method="post">
        <input type="text" name="changeHobby" placeholder="Enter hobby name">
        <button type="submit">submit</button>
    </form>

</section>
<link rel="stylesheet" href="/views/styles/homepage.css">