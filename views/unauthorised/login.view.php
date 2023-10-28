<link rel="stylesheet" href="/views/public/styles/unauthorized.css" />
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        Invalid credentials
    </div>
<?php }
if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        You must be authorized to view this page!
    </div>
<?php }
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
?>

<div class="container">

    <form action="/login" method="post">
        <div class="form-info">
            <div class="title">Login</div>
            <div class="input-field">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Enter your Email" required/>
            </div>

            <div class="input-field">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="password" placeholder="Enter your password" required />
            </div>
        </div>
        <input class="button" type="submit" value="Login" />
        <a href="/register" class="button" type="submit" value="Register">register here!</a>
    </form>
    <a href="/forgot" class="button" type="submit" value="forgot_password">forgot password?</a>
</div>