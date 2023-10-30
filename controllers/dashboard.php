<?php

$users = customStatement("SELECT * FROM users");

require $_SERVER['DOCUMENT_ROOT'] . '/views/dashboard.view.php';
