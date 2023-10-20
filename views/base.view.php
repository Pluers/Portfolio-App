<html lang="nl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>
    <link rel="icon" type="image/x-icon" href="https://twinery.org/cookbook/stylesheets/logo.svg">
    <!-- CSS for the index -->
    <link rel="stylesheet" href="style.css">
    <!-- Link the icons from Google -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <header>
        <input type="checkbox" name="">
        <nav>
            <dropdown>
                <button>
                    category
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                    <a href="#">Link 4 is a very long word</a>
                </dropdownlist>
            </dropdown>
            <dropdown>
                <button>
                    category
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                    <a href="#">Link 4 is a very long word</a>
                </dropdownlist>
            </dropdown>
            <dropdown>
                <button>
                    category
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                    <a href="#">Link 4 is a very long word</a>
                </dropdownlist>
            </dropdown>

            <a href="/logout">
                <span class="material-symbols-rounded">
                    logout
                </span>
                <p>Log out</p>
            </a>

            <form method="GET" action="/?q=">
                <input type="search" placeholder="Search" name="q" value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>">
                <button type="submit">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                </button>
            </form>
        </nav>
    </header>
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
                <a href="/logout">
                    <span class="material-symbols-rounded">
                        logout
                    </span>
                    <p>Log out</p>
                </a>
            </nav>
        </sidebar>
        <content>
            <?php
            global $routes;
            if (array_key_exists($_SERVER['REQUEST_URI'], $routes)) {
                require $routes[$_SERVER['REQUEST_URI']];
            } else {
                echo "404";
            }
            ?>
            <footer>
                <p>&copy;Jerrican</p>
            </footer>
        </content>
    </main>
</body>

</html>