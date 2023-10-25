<link rel="stylesheet" href="/views/public/styles/unauthorized.css"/>
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        Username is already in use.
    </div>
<?php }
if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        Emailaddress is already in use.
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
                <input type="text" id="username" name="username" placeholder="Enter your username" required/>
            </div>

            <div class="input-field">
                <label for="firstname">First name</label>
                <input type="text" id="firstname" name="firstname" placeholder="Enter your username" required/>
            </div>

            <div class="input-field">
                <label for="lastname">Last name</label>
                <input type="text" id="lastname" name="lastname" placeholder="Enter your username" required/>
            </div>

            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your username" required/>
            </div>

            <div class="input-field">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Enter your password" required/>
            </div>

        </div>
        <input class="button" type="submit" value="Register"/>
    </form>
</div>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';
?>