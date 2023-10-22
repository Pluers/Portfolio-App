<link rel="stylesheet" href="/views/public/styles/unauthorizedbase.css" />
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';

global $routesUnAuthorised;
if (array_key_exists(getSanitizedUri(), $routesUnAuthorised)) {
    require $routesUnAuthorised[getSanitizedUri()];
} else {
    echo "404";
}

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';
?>