<html lang="nl">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>
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
                <a href="/profile">
                    <span class="material-symbols-rounded">
                        person
                    </span>
                    <p>Profile</p>
                </a>
            </nav>
        </sidebar>
        <content>
            <?php
            $App = require "private.php";
            $dbconn = $App['database'];
            $servername = $App['database']['servername'];
            $username = $App['database']['username'];
            $password = $App['database']['drowssap'];
            $dbname = $App['database']['dbname'];
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