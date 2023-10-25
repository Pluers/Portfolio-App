<link rel="stylesheet" href="/views/public/styles/editprofilepage.css">
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';
?>
<form action="/controllers/edit_profile.php" method="POST">
    <label for="username">Username</label>
    <input type="text" name="username" id="username" value="<?= $user['username'] ?>">
    <label for="email">Email</label>
    <input type="text" name="email" id="email" value="<?= $user['email'] ?>">
    <label for="password">Password</label>
    <input type="password" name="password" id="password" value="<?= $user['password'] ?>">
    <label for="confirm_password">Confirm Password</label>
    <input type="password" name="confirm_password" id="confirm_password" value="<?= $user['password'] ?>">
    <label for="isAdmin">Admin</label>
    <input type="checkbox" name="isAdmin" id="isAdmin" value="<?= $user['isAdmin'] ?>">
    <input type="submit" value="Submit">
</form>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php'; ?>


    

    <main>
    <!-- input fields and edit buttons for all categories below -->
    <h1> Edit Profile</h1>
    
    <section>
    <h1>Personal Information</h1> 
    <form action="/placeholder">
    <label for="email">First name:</label>
    <input type="text" placeholder="John"> <br>
    <label for="wachtwoord">Last name:</label>
    <input type="text" placeholder="Van den Berg"> <br>
<form action="/placeholder">
<label for="Voornaam">Email:</label>
<input type="text" Placeholder="JohnvanDenBerg@gmail.com"> <br>
<label for="Achternaam">Password:</label>
<input type="text" placeholder="**********"> <br>
<label for="Achternaam"> Confirm Password:</label>
<input type="text" Placeholder="**********"> <br>
<form action="/placeholder">
<textarea name="" id="" cols="30" rows="2" Placeholder="Hobbies"></textarea> <br>
<form action="/placeholder">
<textarea name="" id="" cols="30" rows="2" Placeholder="Job Experiences"></textarea> <br>
<textarea name="" id="" cols="30" rows="2" Placeholder="Educations"></textarea> <br>
<input type="submit" value="Submit">
</form>
</section>
<section>
<h1>Your Profile</h1>
<div>
<p>druk op de "Bestand Kiezen" knop om een bestand te uploaden</p>  
<form action="/placeholder">
<circles>
<img src="" alt="" class="circle">
<p>preview of profile picture</p>
<img src="" alt="" class="circle">
</circles>
<input type="file" id="" name="">
<input type="submit" Value="Submit"> 
<about>
<img src="" alt="" class="square">
<form action="/placeholder">
<textarea name="" id="" cols="30" rows="2" placeholder="  Edit Text"></textarea>
</about>
<input type="submit" value="Submit">
</div>
 </form>
 </section>
    </form>
</section>
    </form>
</main>