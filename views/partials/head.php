<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="<?= 'views/public/favicon.png' ?>" />

    <!-- CSS for the index -->
    <link rel="stylesheet" href="/views/public/styles/style.css" />

    <!-- Link the icons from Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <!-- link the styles from separate pages -->
    <?php if (getSanitizedUri() === '/dashboard') { ?>
        <link rel="stylesheet" href="/views/public/styles/homepage.css">
    <?php } else if (getSanitizedUri() === '/editprofile') { ?>
        <link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
        <script src="/views/public/script/editprofile.js"></script>
        <?php if (isset($_GET['tab']) && $_GET['tab'] === 'hobbies') { ?>
            <script src="/views/public/script/editprofilehobbies.js"></script>
        <?php
        } ?>
    <?php } else if (getSanitizedUri() === '/profile') { ?>
        <link rel="stylesheet" href="/views/public/styles/profilepage.css">
    <?php } else if (getSanitizedUri() === '/login' || getSanitizedUri() === '/register' || getSanitizedUri() === '/forgot' || getSanitizedUri() === '/reset') { ?>
        <link rel="stylesheet" href="/views/public/styles/unauthorized.css" />
    <?php } ?>
</head>