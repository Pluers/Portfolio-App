<body>
    <header>
        <input type="checkbox" name="">
        <nav>
            <!-- logout knop voor mobile -->
            <a href="/logout">
                <span class="material-symbols-rounded">
                    logout
                </span>
                <p>Log out</p>
            </a>
            <?php
            function createDropdown($title, $query, $fields)
            {
                $items = customStatement($query);
                echo '<dropdown>
                    <button>
                        ' . $title . '
                        <span class="material-symbols-rounded">
                            arrow_drop_down
                        </span>
                    </button>
                    <dropdownlist>';
                foreach ($items as $item) {
                    $text = '';
                    foreach ($fields as $field) {
                        $text .= $item[$field] . ' ';
                    }
                    echo "<a href='#'>" . trim($text) . "</a>";
                }
                echo '</dropdownlist>
                </dropdown>';
            }

            createDropdown('Hobbies', 'SELECT hobby_name FROM hobbies', ['hobby_name']);
            createDropdown('Educations', 'SELECT education_name FROM educations', ['education_name']);
            createDropdown('Job Experiences', 'SELECT company_name, job_title FROM jobexperiences', ['company_name', 'job_title']);

            if (isset($_SESSION[SESSION_KEY_USER_ID]) && $devmode) {
                echo "Current user id: " . $_SESSION[SESSION_KEY_USER_ID];
            }
            ?>
            <!-- searchbar -->
            <form method="GET" action="/search?q=">
                <input type="search" placeholder="Search" name="q" value="<?php if (isset($_GET['q'])) echo $_GET['q']; ?>">
                <button type="submit">
                    <span class="material-symbols-rounded">
                        search
                    </span>
                </button>
            </form>
        </nav>
    </header>
</body>