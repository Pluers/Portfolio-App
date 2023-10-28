<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<!-- input fields and edit buttons for all categories below -->

<section>
    <h1> Edit Profile</h1>
    <h2>Personal Information</h2>
    <form method="post" enctype="multipart/form-data">
        <img src="/views/public/images/<?= $profileimg ?>" />
        <label for="fileToUpload" id="uploadImage">
            <!-- hidden file input that gets replaced by the span -->
            <input type="file" name="fileToUpload" id="fileToUpload" accept="image/*" /><br>
            <span>Select Image
                <span class="material-symbols-rounded">
                    add_photo_alternate
                </span>
            </span>
        </label>
        <input type="submit" value="Upload" name="uploadpfp">
    </form>
    <form method="post">
        <label for="FirstName">First name:</label>
        <input type="text" placeholder="First Name" name="first_name" value="<?= getUserInfo()["first_name"] ?>"> <br>
        <label for="LastName">Last name:</label>
        <input type="text" placeholder="Last Name" name="last_name" value="<?= getUserInfo()["last_name"] ?>"> <br>
        <label for="Email">Email:</label>
        <input type="text" Placeholder="Email" name="email" value="<?= getUserInfo()["email"] ?>"> <br>
        <a href="/forgot">Change Password</a>

        <button>Add hobby</button>
        <br>
        <button>Add Job Experience</button>
        <br>
        <button> Add education </button>
        <br>
        <input type="submit" value="Submit" name="edituser">
    </form>
</section>
<section>
    <h1>Your Portfolio</h1>
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