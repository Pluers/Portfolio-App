<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<div id="notfound">
    <h1>404: Page Not Found</h1>
    <p>Sorry, the page you're looking for doesn't exist.</p>
    <a href="/">
        <input type="button" value="Back to Homepage">
    </a>
</div>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>