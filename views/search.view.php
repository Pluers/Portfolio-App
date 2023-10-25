<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';

if (!empty(search())) {
    $hasResults = false;
    foreach (search() as $title => $statementresults) {
        if (!empty($statementresults)) {
            $hasResults = true;
            echo "<h1>" . $title . "</h1>";
            foreach ($statementresults as $results) {
                foreach ($results as $result) {
                    echo $result . "<br>";
                }
            }
        }
    }
    if (!$hasResults) {
        echo "No Results";
    }
} else {
    echo "No Results";
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';
