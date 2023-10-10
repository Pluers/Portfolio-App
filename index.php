<?php

$App = require "private.php";
$dbconn = $App['database'];

switch ($_SERVER['REQUEST_URI']) {
    case '':
    case '/':
        require __DIR__ . '/views/index.view.html';
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

<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">