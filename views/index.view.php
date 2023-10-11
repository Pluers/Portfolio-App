<html lang="nl">
<link rel="stylesheet" href="style.css">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ProfielPlus</title>
</head>

<body>
    <header>
        <nav id="menuToggle">
            <dropdown>
                <button>
                    category
                    <span class=" material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <a href="#">Link 1</a>
                    <a href="#">Link 2</a>
                    <a href="#">Link 3</a>
                </dropdownlist>
            </dropdown>
            <dropdown>
                <button>
                    category
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
            </dropdown>
            <dropdown>
                <button>
                    category
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
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
            // Get users from the database
            $result = sqlStatement($conn, "SELECT modules.modules, users.username, modules_has_users.grade FROM modules_has_users JOIN users, modules WHERE users.id = modules_has_users.userId AND modules.id = modules_has_users.moduleId");
            foreach ($result as $user) {
                echo $user['modules'] . " " . $user['username'] . " " . $user['grade'] . '<br>';
            }
            ?>
            <!-- de layout aanpassen naar de 2x2 layout en margin links en rechts -->
            <section>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
                <article>
                    <img src="" alt="" class="square">
                    <p>Person</p>
                </article>
            </section>
            <footer>
                <p>text</p>
            </footer>
        </content>
    </main>
</body>

</html>