<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<!-- input fields and edit buttons for all categories below -->

<section>
    <h1> Edit Profile</h1>
    <h2>Personal Information</h2>


    <form action="" method="post" enctype="multipart/form-data">
        <img src="/views/public/images/<?= $_SESSION['profile_picture'] ?>" alt="">
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="upload">
    </form>
    <form action=" <?php editUserInfo() ?>" method="post">
        <label for="FirstName">First name:</label>
        <input type="text" placeholder="First Name" name="firstName" value="<?= updateUserInfo()["firstName"] ?>"> <br>
        <label for="LastName">Last name:</label>
        <input type="text" placeholder="Last Name" name="lastName" value="<?= updateUserInfo()["lastName"] ?>"> <br>
        <label for="Email">Email:</label>
        <input type="text" Placeholder="Email" name="email" value="<?= updateUserInfo()["email"] ?>"> <br>
        <a href="/forgot">Change Password</a>

        <button>Add hobby</button>
        <br>
        <button>Add Job Experience</button>
        <br>
        <button> <a href=" /about"> Add education</a></button>
        <br>
        <input type="submit" value="Submit" name="edituser">
    </form>
</section>
<section>
    <h1>Your Profile</h1>
    <div>
        <p>druk op de "Bestand Kiezen" knop om een bestand te uploaden</p>
        <form action="">

            <submit>

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

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>