<?php

$users = customStatement("SELECT users.username, users.isAdmin FROM users");

require $_SERVER['DOCUMENT_ROOT'] . '/views/index.view.php';
