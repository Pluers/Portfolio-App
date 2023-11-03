<?php
// start session
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';

// VARIABLES
$databaseInfo = retrieveConfigurationSettingsFromIni('database');
$settingsInfo = retrieveConfigurationSettingsFromIni('settings');

$devmode = $settingsInfo['developer_mode'];
$loggedIn = isset($_SESSION[SESSION_KEY_USER_ID]) || $devmode = true ? $settingsInfo['logged_in'] : "";
$targetDirImage = $_SERVER['DOCUMENT_ROOT'] . "/views/public/images/";

$conn = (new Connection($databaseInfo['servername'], $databaseInfo['dbname'], $databaseInfo['username'], $databaseInfo['drowssap']))->conn;

// zet de searchquery naar wat er in de input field staat of in de url als het niet leeg is, als het leeg is laat het dan leeg
isset($_GET['q']) ? $searchq = $_GET['q'] : $searchq = '';

// als je niet ingelogd bent en je wilt via de url toch langs de login proberen te komen wordt je geredirect naar de /login.
if (getSanitizedUri() === '/') {
    if ($loggedIn) {
        redirect('/dashboard');
    } else {
        redirect('/login');
    }
}

//routes voor paginas
$routes = [
    '/dashboard' => ['path' => 'controllers/dashboard.php', 'auth' => true],
    '/about' => ['path' => 'controllers/about.php', 'auth' => true],
    '/logout' => ['path' => 'controllers/logout.php', 'auth' => true],
    '/profile' => ['path' => 'controllers/profile.php', 'auth' => true],
    '/editprofile' => ['path' => 'controllers/edit_profile.php', 'auth' => true],
    '/search' => ['path' => 'controllers/search.php', 'auth' => true],
    '/login' => ['path' => 'controllers/login.php', 'auth' => false],
    '/register' => ['path' => 'controllers/register.php', 'auth' => false],
    '/forgot' => ['path' => 'controllers/forgot_password.php', 'auth' => false],
    '/reset' => ['path' => 'controllers/reset_password.php', 'auth' => false],
];



if (array_key_exists(getSanitizedUri(), $routes)) {
    $route = $routes[getSanitizedUri()];
    // check voor de normale paginas
    if ($route['auth'] && !$loggedIn) {
        redirect('/login?error=2');
        return;
    }
    require $route['path'];
} else {
    // anders error
    require $_SERVER['DOCUMENT_ROOT'] . '/core/404.php';
}
