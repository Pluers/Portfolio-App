<link rel="stylesheet" href="/views/public/styles/unauthorized.css" />
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        Username wordt al gebruikt!
    </div>
<?php }

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
?>
<div class="container">
    <form action="/controllers/register.php" method="post">
        <div class="form-info">
            <div class="title">register</div>

            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required />
            </div>

            <div class="input-field">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="password" placeholder="Enter your password" required />
            </div>
        </div>
        <input class="button" type="submit" value="Register" />
    </form>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';
?>