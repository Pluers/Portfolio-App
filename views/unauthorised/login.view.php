<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        The email and password do not match.
    </div>
<?php }
if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        You must be authorized to view this page!
    </div>
<?php } ?>

<div class="container">

    <form action="/login" method="post">
        <div class="form-info">
            <h2>Login</h2>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" required />
            </div>

            <div class="input-field">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="password" placeholder="Enter your password" required />
            </div>
        </div>
        <input type="submit" value="Login" />
        <a href="/forgot" type="submit" value="forgot_password">forgot password</a>
        <a href="/register" type="submit" value="Register">register here</a>
    </form>
</div>