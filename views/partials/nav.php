<main>
    <sidebar>
        <nav>
            <?php if ($loggedIn) { ?>
                <a href="/">
                    <span class="material-symbols-rounded">
                        home
                    </span>
                    <p>Home</p>
                </a>
                <a href="/about">
                    <span class="material-symbols-rounded">
                        help
                    </span>
                    <p>About</p>
                </a>
                <a href="/profile?user_id=<?= $user_id ?? $_SESSION[SESSION_KEY_USER_ID] ?>">
                    <span class="material-symbols-rounded">
                        person
                    </span>
                    <p>Profile</p>
                </a>
                <?php if ($devmode) { ?>
                    <a href="/login">
                        <span class="material-symbols-rounded">
                            login
                        </span>
                        <p>Log in</p>
                    </a>
                    <a href="/register">
                        <span class="material-symbols-rounded">
                            person_add
                        </span>
                        <p>Register</p>
                    </a>
                <?php }
                if ($loggedIn) { ?>
                    <a href="/logout" <?= $devmode ? "style='background:red'" : "" ?>>
                        <span class="material-symbols-rounded">
                            logout
                        </span>
                        <p>Log out</p>

                    </a>
                <?php } ?>
            <?php } else { ?>
                <a href="/">
                    <span class="material-symbols-rounded">
                        login
                    </span>
                    <p>Login</p>
                </a>
            <?php } ?>
        </nav>
    </sidebar>
    <content>