<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
// error messages
if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        Emailaddress is already in use.
    </div>
<?php } ?>
<div class="container">
    <form action="/register" method="post">
        <div class="form-info">
            <h2>Register</h2>
            <div class="input-field">
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required />
            </div>

            <div class="input-field">
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required />
            </div>

            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required />
            </div>

        </div>
        <input type="submit" value="Register" />
    </form>
</div>