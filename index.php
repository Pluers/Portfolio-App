<?php

$info = parse_ini_file("env.ini", true);
$hostname = $info['database']['servername'];
$username = $info['database']['username'];
$password = $info['database']['drowssap'];
$dbname = $info['database']['dbname'];
try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();
}
require "modules/query-builder.php";

$_SESSION['loggedIn'] = true;
$loggedIn = $_SESSION['loggedIn'];
if (!$loggedIn) {
    header('Location: http://www.google.com');
} else {
    require "views/base.view.php";
};


function routing()
{
    if (isset($_GET['q'])) {
        $searchq = $_GET['q'];
    } else {
        $searchq = '';
    }
    // ROUTING
    switch ($_SERVER['REQUEST_URI']) {
        case '':
        case '/?q=' . urlencode($searchq):
            require __DIR__ . '/modules/search.php';
            break;
        case '/':
            require __DIR__ . '/views/index.view.php';
            break;
        case '/about':
            require __DIR__ . '/views/about.view.php';
            break;
        case '/profile':
            require __DIR__ . '/views/profile.view.php';
            break;
        case '/edit':
            require __DIR__ . '/views/editprofile.view.php';
            break;
        default:
            http_response_code(404);
            require __DIR__ . '/404.php';
            break;
    }
}
