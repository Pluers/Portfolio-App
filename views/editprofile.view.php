<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<form action="/controllers/edit_profile.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?= $user['username'] ?>">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= $user['email'] ?>">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="<?= $user['password'] ?>">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" value="<?= $user['password'] ?>">
    <label for="isAdmin">Admin</label>
    <input type="checkbox" name="isAdmin" id="isAdmin" value="<?= $user['isAdmin'] ?>">
    <input type="submit" value="Submit">
</form>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>