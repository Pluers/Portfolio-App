<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="/views/styles/registerpage.css"/>
    <meta charset="UTF-8">
    <title>Login/Register</title>

</head>

<body>

<div class="container">

    <form action="register.php" method="post">
        <div class="form-info">
            <div class="title">Login</div>

            <div class="input-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="email" placeholder="Enter your username" required>
            </div>

            <div class="input-field">
                <label for="pwd">Password</label>
                <input type="password" id="pwd" name="password" placeholder="Enter your password" required>
            </div>
        </div>
        <div class="password-reset">
            <p><a href="#">Forgot password?</a></p>
        </div>

        <div class="button">
            <input type="submit" value="Login">
        </div>




    </form>
</div>
</body>
<footer>
</footer>
</html>
