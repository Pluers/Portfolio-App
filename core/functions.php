<?php
// redirect de request naar een andere locatie
function redirect($url, $permanent = false)
{
    header('Location: ' . $url, true, $permanent ? 301 : 302);

    exit();
}

// haal de settings op van de ini file
function retrieveConfigurationSettingsFromIni($subject)
{
    // SERVER['document_root'] is the projectroot.
    $info = parse_ini_file($_SERVER['DOCUMENT_ROOT'] . '/env.ini', true, INI_SCANNER_TYPED);

    if ($info === false) {
        throw new Exception('Could not read the ini file!');
    }

    return $info[$subject];
}

// haal de parameters van de URI weg (de '?' en '&' symbolen).
// return alleen /login zonder de '?error=1'
function getSanitizedUri(): string
{
    return explode('?', $_SERVER['REQUEST_URI'])[0];
}

// haal string op zonder speciale tekens
function getSanitizedStr($string)
{
    return $string = preg_replace('/[\'\/~`\!?@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', ' ', $string);
}

// haal user saettings op
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

// check voor edituser
function isCurrentUserAllowedToEditUser()
{
    if ($_SESSION[SESSION_KEY_ADMIN] === 0 || $_SESSION[SESSION_KEY_ADMIN] === false) {
        if (!empty($_GET['user_id']) && (int) $_GET['user_id'] !== $_SESSION[SESSION_KEY_USER_ID]) {
            return false;
        }
    }
    return true;
}


// run een custom sql statement
function customStatement($sql, $params = [])
{
    global $conn;

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

// een constant is een variable die je niet aan kan passen.
const SESSION_KEY_USER_ID = 'user_id';
const SESSION_KEY_ADMIN = 'admin';
