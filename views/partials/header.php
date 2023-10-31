<body>
    <header>
        <input type="checkbox" name="">
        <nav>
            <a href="/logout">
                <span class="material-symbols-rounded">
                    logout
                </span>
                <p>Log out</p>
            </a>
            <dropdown>
                <button>
                    Hobbies
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <?php
                    $hobbies = customStatement('SELECT hobby_name FROM hobbies');
                    foreach ($hobbies as $hobby) {
                        echo "<a href='#'>" . $hobby['hobby_name'] . "</a>";
                    }
                    ?>
                </dropdownlist>
            </dropdown>
            <dropdown>
                <button>
                    Educations
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <?php
                    $educations = customStatement('SELECT education_name FROM educations');
                    foreach ($educations as $education) {
                        echo "<a href='#'>" . $education['education_name'] . "</a>";
                    }
                    ?>
                </dropdownlist>
            </dropdown>
            <dropdown>
                <button>
                    Job Experiences
                    <span class="material-symbols-rounded">
                        arrow_drop_down
                    </span>
                </button>
                <dropdownlist>
                    <?php
                    $jobexperiences = customStatement('SELECT company_name, job_title FROM jobexperiences');
                    foreach ($jobexperiences as $jobexperience) {
                        echo "<a href='#'>" . $jobexperience['company_name'] . " - " . $jobexperience['job_title'] . "</a>";
                    }
                    ?>
                </dropdownlist>
            </dropdown>
            <?php
            if (isset($_SESSION[SESSION_KEY_USER_ID]) && $devmode) {
                echo "Current user id: " . $_SESSION[SESSION_KEY_USER_ID];
            }
            ?>
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