<?php
// redirect the request to another location
function redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

// retrieves the settings from the env.ini settings
function retrieveConfigurationSettingsFromIni($subject)
{
    // SERVER['document_root'] is the projectroot.
    $info = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/env.ini', true, INI_SCANNER_TYPED);

    if ($info === false) {
        throw new Exception('Could not read the ini file!');
    }

    return $info[$subject];
}

// Remove all the parameters from the URI (all the '?' and '&' symbols).
// and return just /login without the '?error=1'
function getSanitizedUri(): string
{
    return explode('?', $_SERVER['REQUEST_URI'])[0];
}

function getSanitizedStr($string)
{
    return $string = preg_replace('/[\'\/~`\!?@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', ' ', $string);
}

function getUserInfo($userId = null)
{
    global $conn;
    if (empty($userId)) {
        $userId = $_SESSION[SESSION_KEY_USER_ID];
    }

    $stmt = $conn->prepare('SELECT * FROM users WHERE users_id = :user_id');
    $stmt->execute([':user_id' => $userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user === false) {
        throw new LogicException('The provided user does not exist: ' . $userId);
    }

    return $user;
}

function isCurrentUserAllowedToEditUser() {
    if ($_SESSION[SESSION_KEY_ADMIN] === 0 || $_SESSION[SESSION_KEY_ADMIN] === false) {
        if (!empty($_GET['user_id']) && (int) $_GET['user_id'] !== $_SESSION[SESSION_KEY_USER_ID]) {
            return false;
        }
    }
    return true;
}

// een constant is een variable die je niet aan kan passen.
const SESSION_KEY_USER_ID = 'user_id';
const SESSION_KEY_ADMIN = 'admin';
