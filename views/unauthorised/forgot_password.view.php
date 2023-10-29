<?php if (isset($_GET['error']) && (int)$_GET['error'] === 1) { ?>
    <div class="alert">
        That email does not exist!
    </div>
<?php } ?>
<?php if (isset($_GET['error']) && (int)$_GET['error'] === 2) { ?>
    <div class="alert">
        Your token has expired!
    </div>
<?php } ?>
<div class="container">

    <form action="/forgot" method="post">
        <div class="form-info">
            <div class="title">Forgot password</div>

            <div class="input-field">
                <label for="email">Email adress</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required />
            </div>
        </div>
        <input class="button" type="submit" value="Reset password" />
    </form>
</div>