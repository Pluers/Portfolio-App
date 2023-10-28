<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<!-- input fields and edit buttons for all categories below -->

<section>
    <h1> Edit Profile</h1>
    <form method="post" enctype="multipart/form-data" class="setprofilepicture">
        <img src="/views/public/images/<?= $profileimg ?>" />
        <label for="fileToUpload">
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
    <form method="post" class="editprofile">
        <label for="first_name">First name:</label>
        <input type="text" placeholder="First Name" name="first_name" value="<?= getUserInfo()["first_name"] ?>">
        <label for="last_name">Last name:</label>
        <input type="text" placeholder="Last Name" name="last_name" value="<?= getUserInfo()["last_name"] ?>">
        <label for="email">Email:</label>
        <input type="text" Placeholder="Email" name="email" value="<?= getUserInfo()["email"] ?>">
        <label for="change_password">Password: </label>
        <a href="/forgot" target="_blank">Change Password
            <span class="material-symbols-rounded">
                open_in_new
            </span>
        </a>
        <input type="submit" value="Submit" name="edituser">
    </form>
</section>
<section>

    <?php
    $active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'about';
    ?>

    <main>
        <nav>
            <ul>
                <li><a href="?tab=about" <?php if ($active_tab === 'about') {
                                                echo 'class="active"';
                                            } ?>>About</a></li>
                <li><a href="?tab=attributes" <?php if ($active_tab === 'attributes') {
                                                    echo 'class="active"';
                                                } ?>>Attributes</a></li>
                <li><a href="?tab=more-info" <?php if ($active_tab === 'more-info') {
                                                    echo 'class="active"';
                                                } ?>>More Info</a></li>
            </ul>
        </nav>
        <?php if ($active_tab === 'about') {
            aboutPage();
        } elseif ($active_tab === 'attributes') {
            // code for the 'attributes' tab
        } elseif ($active_tab === 'more-info') {
            // code for the 'more-info' tab
        } ?>
    </main>


</section>

<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>