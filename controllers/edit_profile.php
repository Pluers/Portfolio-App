<?php
global $conn;
$user_id = $_SESSION[SESSION_KEY_USER_ID];

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    function profilePage()
    {
        global $target_dir_img, $user_id, $profileimg;

        if ($_SESSION[SESSION_KEY_ADMIN] === 0 || $_SESSION[SESSION_KEY_ADMIN] === false) {
            if (isset($_GET['user_id']) && $_GET['user_id'] !== $_GET[SESSION_KEY_USER_ID]) {
                redirect('/profile');
            }
        }

        if (isset($_POST['uploadpfp'])) {
            $target_file = $target_dir_img . "profile_picture_" . $user_id . ".jpg";
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $extensions_arr)) {
                if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $target_file)) {
                    $_SESSION['profile_picture'] = "profile_picture_" . $user_id . ".jpg";
                }
            }
        }
    }


    function hobbiesPage()
    {
        global $target_dir_img, $gethobbies, $hobbyimg, $hobby_name, $user_hobbies;

        if (isset($_POST['create_hobby'])) {
            $target_file = $target_dir_img . "hobby_" . $hobby_name . ".jpg";
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $extensions_arr = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $extensions_arr)) {
                if (move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $target_file)) {
                    move_uploaded_file($_FILES['imgToUpload']['tmp_name'], $target_file);
                }
            }
        }
    }

// functie om de user informatie op te halen.
    function getUserInfo()
    {
        global $conn;
        $user_id = $_SESSION[SESSION_KEY_USER_ID];
        $stmt = $conn->prepare('SELECT * FROM users WHERE users_id = :user_id');
        $stmt->execute([':user_id' => $user_id]);
        $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user_info) {
            return $user_info;
        }
    }

// variables 

    $gethobbies = customStatement('SELECT * FROM hobbies');
    $user_hobbies = customStatement('SELECT * FROM user_hobbies JOIN hobbies WHERE user_hobbies.users_id = :user_id', [':user_id' => $user_id]);
    $hobby_name = isset($_POST['create_hobby_name']) ? $_POST['create_hobby_name'] : "default";

// check if profile picture exists
    if (file_exists($target_dir_img . "profile_picture_" . $user_id . ".jpg")) {
        $profileimg = "profile_picture_" . $user_id . ".jpg";
    } else if (file_exists($target_dir_img . "hobby_" . $hobby_name . ".jpg")) {
        $hobbyimg = "hobby_" . $hobby_name . ".jpg";
    } else {
        $hobbyimg = "default_hobby.jpg";
        $profileimg = "default.png";
    }


    require $_SERVER['DOCUMENT_ROOT'] . '/views/editprofile.view.php';
    return;
}

// check the forms and do sql querys
if (isset($_POST['edituser'])) {
    customStatement('UPDATE users SET first_name = :first_name, last_name = :last_name, email = :email WHERE users_id = :user_id', [':user_id' => $user_id, ':first_name' => $_POST['first_name'], ':last_name' => $_POST['last_name'], ':email' => $_POST['email']]);
} else if (isset($_POST["add_hobby_to_profile"])) {
    $hobby_id = (int)$_POST['hobbiesList'];
    $stmt = $conn->prepare('SELECT * FROM user_hobbies WHERE users_id = :user_id AND hobbies_id = :hobby_id');
    $stmt->execute([':user_id' => $user_id, ':hobby_id' => $hobby_id]);
    // only insert unique combinations
    if ($stmt->fetch() === false) {
        $result = customStatement('INSERT IGNORE INTO user_hobbies (users_id, hobbies_id) VALUES (:user_id, :hobby_id)', [':user_id' => $user_id, ':hobby_id' => $hobby_id]);
        if ($result === false) {
            throw new Exception('Doet het niet noob');
        }
    }
} else if (isset($_POST["create_hobby"])) {
    // maak hobby aan en zet het in de rij van de hobbies die je kan selecteren
    customStatement('INSERT IGNORE INTO hobbies (hobby_name) VALUE (:hobby_name)', [':hobby_name' => ucfirst($_POST['create_hobby_name'])]);
}

redirect('editprofile?tab='.$_GET['tab']);

