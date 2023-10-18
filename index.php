<?php
require_once "db.php";



$_SESSION['loggedIn'] = true;
$loggedIn = $_SESSION['loggedIn'];
if (!$loggedIn) {
    header('Location: http://www.google.com');
} else {
?>
    <html lang="nl">

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ProfielPlus</title>
        <!-- CSS for the index -->
        <link rel="stylesheet" href="style.css">
        <!-- Link the icons from Google -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    </head>

    <body>
        <header>
            <input type="checkbox" name="" id="">
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

                <searchbox>
                    <input type="text" placeholder="Search">
                    <button>
                        <span class="material-symbols-rounded">
                            search
                        </span>
                    </button>
                </searchbox>
            </nav>
        </header>
        <main>
            <sidebar>
                <nav>
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
                    <?php
                    $loggedIn = true;
                    if ($loggedIn) {
                    ?>
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
                    <?php
                    } else {
                    ?>
                        <a href="/login">
                            <span class="material-symbols-rounded">
                                login
                            </span>
                            <p>Log in</p>
                        </a>
                    <?php
                    }
                    ?>
                </nav>
            </sidebar>
            <content>
                <?php
                // ROUTING
                switch ($_SERVER['REQUEST_URI']) {
                    case '':
                    case '/':
                        require __DIR__ . '/views/index.view.php';
                        break;
                    case '/about':
                        require __DIR__ . '/views/about.view.php';
                        break;
                    case '/profile':
                        require __DIR__ . '/views/profile.view.php';
                        break;
                    case '/hobby%update_hobby':
                        require __DIR__ . '/update_hobby.php';
                        break;
                    default:
                        http_response_code(404);
                        require __DIR__ . '/404.php';
                        break;
                }
                ?>
                <footer>
                    <p>FOOTER</p>
                </footer>
            </content>
        </main>
    </body>

    </html>

<?php
};
?>