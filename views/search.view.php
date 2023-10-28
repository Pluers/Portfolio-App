<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';

if (!empty(search())) {
    $hasResults = false;
    foreach (search() as $title => $statementresults) {
        // check of er resultaten zijn
        if (!empty($statementresults)) {
            $hasResults = true;
            // display de header
            echo "<h1>" . $title . "</h1>";
            // loop door de multidimensional array

            foreach ($statementresults as $results) {
                foreach ($results as $result) {
                    // display de results
                    echo $result . ' ';
                }
                echo '<br>';
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
