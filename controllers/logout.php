<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/functions.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/core/db.php';
unset($_SESSION[SESSION_KEY_USER_ID]);
unset($_SESSION[SESSION_KEY_ADMIN]);
redirect('/login');