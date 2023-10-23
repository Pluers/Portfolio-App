<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';

if (!empty(search())) {
    if (preg_match('/[\'\/~`\!@#\$%\^&\*\(\)_\-\+=\{\}\[\]\|;:"\<\>,\.\?\\\]/', $_GET['q'])) {
        echo "No Results";
        die;
    }
    foreach (search() as $title => $statementresults) {
        if (!empty($statementresults)) {
            echo "<h1>" . $title . "</h1>";
            foreach ($statementresults as $results) {
                foreach ($results as $result) {
                    echo $result . "<br>";
                }
            }
        }
    }
} else {
    echo "No Results";
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';