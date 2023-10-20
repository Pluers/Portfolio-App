<?php
require "core/db.php";
require "modules/query_builder.php";
$loggedIn = ($_SESSION['loggedIn'] = true);

if (isset($_GET['q'])) {
    $searchq = $_GET['q'];
} else {
    $searchq = '';
}
$routes = [
    "/" => "views/index.view.php",
    "/about" => "views/about.view.php",
    "/details" => "views/details.view.php",
    "/contact" => "views/contact.view.php",
    "/skills" => "views/skills.view.php",
    "/?q=" . urlencode($searchq) => "views/search.php"
];
if (!$loggedIn) {
    header('Location: http://www.google.com');
} else {
    require 'views/base.view.php';
}
