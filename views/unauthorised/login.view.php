<link rel="stylesheet" href="/views/public/styles/unauthorized.css" />
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        Invalid credentials
    </div>
<?php }

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
?>
<div class="container">

    <form action="/controllers/login.php" method="post">
        <div class="form-info">
            <div class="title">Login</div>

            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" placeholder="Enter your username" required />
            </div>

            <div class="input-field">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="password" placeholder="Enter your password" required />
            </div>
        </div>
        <input class="button" type="submit" value="Login" />
        <a href="/register" class="button" type="submit" value="Register">Register page</a>
    </form>
</div>
