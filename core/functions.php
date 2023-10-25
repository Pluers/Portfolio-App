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
