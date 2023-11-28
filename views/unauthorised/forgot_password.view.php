<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
// error messages
if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        That email does not exist!
    </div>
<?php } ?>
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        Your token has expired!
    </div>
<?php } ?>
<section>
    <div class="container">
        <form action="/forgot" method="post">
            <div class="form-info">
                <h2>Forgot password</h2>

                <div class="input-field">
                    <input type="email" id="email" name="email" placeholder="Enter your email" required />
                </div>
            </div>
            <input class="button" type="submit" value="Reset password" />
        </form>
    </div>
</section>