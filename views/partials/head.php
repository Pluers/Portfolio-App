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
    $uriStyles = [
        '/dashboard' => '/views/public/styles/homepage.css',
        '/search' => '/views/public/styles/homepage.css',
        '/editprofile' => '/views/public/styles/editprofilepage.css',
        '/profile' => '/views/public/styles/profilepage.css',
        '/login' => '/views/public/styles/unauthorized.css',
        '/register' => '/views/public/styles/unauthorized.css',
        '/forgot' => '/views/public/styles/unauthorized.css',
        '/reset' => '/views/public/styles/unauthorized.css',
    ];

    if (isset($uriStyles[$uri])) {
        echo '<link rel="stylesheet" href="' . $uriStyles[$uri] . '">';
    }

    if ($uri === '/editprofile') {
        echo '<script src="/views/public/script/editprofile.js"></script>';
        if (isset($_GET['tab']) && $_GET['tab'] === 'hobbies') {
            echo '<script src="/views/public/script/editprofilehobbies.js"></script>';
        }
    }
    ?>
</head>