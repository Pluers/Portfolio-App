<?php
require "core/db.php";
require "modules/query_builder.php";

if (isset($_GET['q'])) {
    $searchq = $_GET['q'];
} else {
    $searchq = '';
}
$routes = [
    "/" => "views/index.view.php",
    "/about" => "views/about.view.php",
    "/profile" => "views/profile.view.php",
    "/editprofile" => "views/editprofile.view.php",
    "/?q=" . urlencode($searchq) => "modules/search.php"
];
$loggedIn = ($_SESSION['loggedIn'] = true);
if (!$loggedIn) {
    header('Location: http://www.google.com');
} else {
    require 'views/base.view.php';
}
