<?php

$users = customStatement("SELECT * FROM users");

require $_SERVER['DOCUMENT_ROOT'] . '/views/index.view.php';
