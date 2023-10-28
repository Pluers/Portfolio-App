<?php
// start session
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

$dbenabled ? require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php' : '';
require_once $_SERVER['DOCUMENT_ROOT'] . '/modules/query_builder.php';

$conn = (new Connection($servername, $dbname, $username, $password))->conn;
global $conn;


// zet de searchquery naar wat er in de input field staat of in de url als het niet leeg is, als het leeg is laat het dan leeg
if (isset($_GET['q']) ? $searchq = $_GET['q'] : $searchq = '');

if (isset($_SESSION[SESSION_KEY_USER_ID]) && $devmode) {
    echo "Current user id: " . $_SESSION[SESSION_KEY_USER_ID];
}

//routes voor paginas
$routes = [
    '/dashboard' => 'controllers/index.php',
    '/about' => 'controllers/about.php',
    '/logout' => 'controllers/logout.php',
    '/profile' => 'controllers/profile.php',
    '/edit' => 'controllers/edit_profile.php',
    '/search' => 'controllers/search.php'
];

//routes voor paginas die te maken hebben met authenticatie
$unAuthorizedRoutes = [
    '/login' => 'controllers/login.php',
    '/register' => 'controllers/register.php',
    '/forgot' => 'controllers/forgot_password.php',
    '/reset' => 'controllers/reset_password.php',
];

// als er niks achter de / staat
if (getSanitizedUri() === '/') {
    if ($loggedIn) {
        redirect('/dashboard');
    } else {
        redirect('/login');
    }
}

if (array_key_exists(getSanitizedUri(), $routes)) {
    // check voor de normale paginas
    if (!$loggedIn) {
        redirect('/login?error=2');
        return;
    }
    require $routes[getSanitizedUri()];
} else if (array_key_exists(getSanitizedUri(), $unAuthorizedRoutes)) {
    // check voor de paginas die te maken hebben met authenticatie
    require $unAuthorizedRoutes[getSanitizedUri()];
} else {
    // anders error
    require $_SERVER['DOCUMENT_ROOT'] . '/core/404.php';
}
