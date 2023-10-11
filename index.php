<?php

$App = require "private.php";
$dbconn = $App['database'];
$servername = $App['database']['servername'];
$username = $App['database']['username'];
$password = $App['database']['drowssap'];
$dbname = $App['database']['dbname'];

// ROUTING
switch ($_SERVER['REQUEST_URI']) {
    case '':
    case '/':
        require __DIR__ . '/views/index.view.php';
        break;
    case '/about':
        require __DIR__ . '/views/about.view.php';
        break;
    case '/profile':
        require __DIR__ . '/views/profile.view.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/404.php';
        break;
}
?>

<!-- Link the icons from Google -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />