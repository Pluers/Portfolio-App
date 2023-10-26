<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';

?>


<main>
    <!-- input fields and edit buttons for all categories below -->
    <h1> Edit Profile</h1>
    <section>
        <h1>Personal Information</h1>
        <form action=" <?php edituserinfo() ?>" method="post">
            <input type="text" name="username" value="<?= $_SESSION['username'] ?>">

            <label for="email">First name:</label>

            <input type="text" placeholder="John" name="FirstName"> <br>
            <label for="wachtwoord">Last name:</label>
            <input type="text" placeholder="Van den Berg" name="LastName"> <br>

            <label for="Voornaam">Email:</label>
            <input type="text" Placeholder="JohnvanDenBerg@gmail.com" name="Email"> <br>
            <label for="Achternaam">Password:</label>
            <input type="text" placeholder="**********" name="Password"> <br>
            <label for="Achternaam"> Confirm Password:</label>
            <input type="text" Placeholder="**********" name="confirmpassword"> <br>

            <button>Add hobby</button>
            <br>

            <button>Add Job Experience</button>
            <br>
            <button> <a href="/about"> Add education</a></button>
            <br>
            <input type="submit" value="Submit" name="edituser">
        </form>
    </section>
    <section>
        <h1>Your Profile</h1>
        <div>
            <p>druk op de "Bestand Kiezen" knop om een bestand te uploaden</p>
            <form action="">
                <circles>
                    <img src="" alt="" class="circle">
                    <div class="preview">
                        <p>preview</p>
                        <span class="material-symbols-rounded">
                            arrow_forward
                        </span>
                    </div>
                    <img src="" alt="" class="circle">
                </circles>
                <submit>
                    <input type="file" id="" name="">
                    <input type="submit" Value="Submit">
                </submit>
            </form>
            <about>
                <img src="" alt="" class="square">
                <form action="/placeholder">
                    <textarea name="" id="" cols="30" rows="2" placeholder="  Edit Text"></textarea>
                </form>
            </about>

        </div>
    </section>


</main>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>