<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="/views/public/styles/unauthorizedbase.css" />
    <meta charset="UTF-8">
    <title>Login/Register</title>
</head>

<body>
    <main>
        <content>
            <?php
            global $routesUnAuthorised;
            if (array_key_exists(getSanitizedUri(), $routesUnAuthorised)) {
                require $routesUnAuthorised[getSanitizedUri()];
            } else {
                echo "404";
            }
            ?>
            <footer>
                <p>&copy;Jerrican</p>
            </footer>
        </content>
    </main>
</body>

</html>