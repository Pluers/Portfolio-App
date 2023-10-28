<?php
session_start();
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
$loggedIn = isset($_SESSION[SESSION_KEY_USER_ID]);
$target_dir_img = $_SERVER['DOCUMENT_ROOT'] . "/views/public/images/";

if ($dbenabled) {
    require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/query_builder.php';

$conn = (new Connection($servername, $dbname, $username, $password))->conn;
global $conn;

// sets the searchq variable to whatever is in the input field or in the url if it isn't empty, if it is then leave it blank
if (isset($_GET['q']) ? $searchq = $_GET['q'] : $searchq = '');

if (isset($_SESSION[SESSION_KEY_USER_ID])) {
    echo $_SESSION[SESSION_KEY_USER_ID];
}
$routes = [
    '/dashboard' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/logout' => 'controllers/logout.php',
    '/profile' => 'controllers/profile.php',
    '/edit' => 'controllers/edit_profile.php',
    '/search' => 'controllers/search.php'
];

$unAuthorizedRoutes = [
    '/login' => 'controllers/login.php',
    '/register' => 'controllers/register.php',
    '/forgot' => 'controllers/forgot_password.php',
    '/reset' => 'controllers/reset_password.php',
];

if (getSanitizedUri() === '/') {
    if($loggedIn) {
        redirect('/dashboard');
    } else {
        redirect('/login');
    }
}

if (array_key_exists(getSanitizedUri(), $routes)) {
    if (!$loggedIn) {
        redirect('/login?error=2');

        return;
    }
    require $routes[getSanitizedUri()];
} else if (array_key_exists(getSanitizedUri(), $unAuthorizedRoutes)) {
    require $unAuthorizedRoutes[getSanitizedUri()];
} else {
    require $_SERVER['DOCUMENT_ROOT'] . '/core/404.php';
}
