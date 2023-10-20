<?php

// VARIABLES
$info = parse_ini_file("env.ini", true);
$dbconn = $info['database'];
$servername = $info['database']['servername'];
$username = $info['database']['username'];
$password = $info['database']['drowssap'];
$dbname = $info['database']['dbname'];
$devmode = $info['settings']['developer_mode'];
$dbenabled = $info['settings']['database_enabled'];
$loggedIn = ($_SESSION['loggedIn'] = $info['settings']['logged_in']);

// checks if the user is logged in, if not redirect to 'loginpage'
if (!$loggedIn) {
    header('Location: https://google.com/');
} else {
    require 'views/base.view.php';
}

// REQUIREMENTS
if ($dbenabled) require "core/db.php";
require "modules/query_builder.php";

// sets the searchq variable to whatever is in the input field or in the url if it isn't empty, if it is then leave it blank
if (isset($_GET['q']) ? $searchq = $_GET['q'] : $searchq = '');

// EXEPTIONS
$routes = [
    "/" => "views/index.view.php",
    "/about" => "views/about.view.php",
    "/login" => "views/login.view.php",
    "/logout" => "modules/logout.php",
    "/profile" => "views/profile.view.php",
    "/editprofile" => "views/editprofile.view.php",
    "/?q=" . urlencode($searchq) => "modules/search.php"
];
