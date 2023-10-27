<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
// VARIABLES
$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$settingsInfo = retrieveConfigurationSettingsFromIni('settings');
$dbconn = $databaseInfo;
$servername = $databaseInfo['servername'];
$username = $databaseInfo['username'];
$password = $databaseInfo['drowssap'];
$dbname = $databaseInfo['dbname'];
$devmode = $settingsInfo['developer_mode'];
$dbenabled = $settingsInfo['database_enabled'];
$loggedIn = ($_SESSION['loggedIn'] = $settingsInfo['logged_in']);

if ($dbenabled) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/query_builder.php';

$conn = (new Connection($servername, $dbname, $username, $password))->conn;
global $conn;

// sets the searchq variable to whatever is in the input field or in the url if it isn't empty, if it is then leave it blank
if (isset($_GET['q']) ? $searchq = $_GET['q'] : $searchq = '');

session_start();


$routes = [
    '/' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/logout' => 'modules/logout.php',
    '/profile' => 'controllers/profile.php',
    '/edit' => 'controllers/edit_profile.php',
    '/login' => 'controllers/login.php',
    '/register' => 'controllers/register.php',
    '/forgot' => 'controllers/forgot_password.php',
    '/reset' => 'controllers/reset_password.php',
    '/search' => 'controllers/search.php'
];



// checks if the user is logged in, if not redirect to 'loginpage'
if (!$loggedIn) {
    throw new Exception('You are not logged in!');
} else if (array_key_exists(getSanitizedUri(), $routes)) {
    require $routes[getSanitizedUri()];
} else {
    require $_SERVER['DOCUMENT_ROOT'] . '/core/404.php';
}
