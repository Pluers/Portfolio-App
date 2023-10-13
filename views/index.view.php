<html lang="nl">
<link rel="stylesheet" href="style.css">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>
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
            // TEST CONNECTION
            try {
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
            // Prepare the sql statement
            function sqlStatement($conn, $sql)
            {
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
            ?>
            <section>
                <?php
                $users = sqlStatement($conn, "SELECT users.username FROM users");
                foreach ($users as $user) {
                    echo
                    "<article><img class='square'><p>" . $user['username'] . "</p><br></article>";
                }
                ?>
            </section>
            <footer>
                <p>FOOTER</p>
            </footer>
        </content>
    </main>
</body>

</html>