<link rel="stylesheet" href="/views/public/styles/unauthorized.css" />

<div class="container">

    <form action="/controllers/reset_password.php" method="post">
        <div class="form-info">
            <div class="title">Reset password</div>

            <input type="hidden" name="reset_token" value="<?= $_GET['token']; ?>"/>

<!-- hier word meteen de email meegenomen vanaf de forgot password pagina en de input wordt disabled zodat hij niet veranderd kan worden door de user.-->
            <div class="input-field">
                <label for="email">Email adress</label>
                <input disabled type="email" id="email" name="email" placeholder="Enter your email" value="<?= $email; ?>" />
            </div>

            <div class="input-field">
                <label for="password"> New password</label>
                <input type="password" id="password" name="password" placeholder="Enter your new password" />
            </div>
        </div>
        <input class="button" type="submit" value="Create new password" />
    </form>
</div>

