<main>
    <sidebar>
        <nav>
            <!-- REDO as input selection -->
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
            <a href="/profile">
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
                    <p>register</p>
                </a>
            <?php } ?>
            <a href="/logout">
                <span class="material-symbols-rounded">
                    logout
                </span>
                <p>Log out</p>
            </a>
        </nav>
    </sidebar>
    <content>