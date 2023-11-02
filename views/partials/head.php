<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>

    <!-- favicon -->
    <link rel="icon" type="image/x-icon" href="<?= 'views/public/favicon.png' ?>" />

    <!-- CSS voor alle pagina's -->
    <link rel="stylesheet" href="/views/public/styles/style.css" />

    <!-- Link de icons van Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <?php
    // link de styles aparte pagina's
    $uri = getSanitizedUri();
    switch ($uri) {
        case '/dashboard':
        case '/search':
            echo '<link rel="stylesheet" href="/views/public/styles/homepage.css">';
            break;
        case '/editprofile':
            echo '<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">';
            echo '<script src="/views/public/script/editprofile.js"></script>';
            if (isset($_GET['tab']) && $_GET['tab'] === 'hobbies') {
                echo '<script src="/views/public/script/editprofilehobbies.js"></script>';
            }
            break;
        case '/profile':
            echo '<link rel="stylesheet" href="/views/public/styles/profilepage.css">';
            break;
        case '/login':
        case '/register':
        case '/forgot':
        case '/reset':
            echo '<link rel="stylesheet" href="/views/public/styles/unauthorized.css">';
            break;
    }
    ?>
</head>