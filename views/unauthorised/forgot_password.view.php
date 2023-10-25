<link rel="stylesheet" href="/views/public/styles/unauthorized.css" />

<div class="container">

    <form action="/controllers/forgot_password.php" method="post">
        <div class="form-info">
            <div class="title">Forgot password</div>

            <div class="input-field">
                <label for="email">Email adress</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />
            </div>
        </div>
        <input class="button" type="submit" value="Send new password" />
    </form>
</div>

