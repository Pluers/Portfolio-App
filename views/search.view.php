<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/head.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/header.php';
require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/nav.php';

function removeDuplicates($array, $key)
{
    $temp_array = array();
    $i = 0;
    $key_array = array();

    foreach ($array as $val) {
        if (!in_array($val[$key], $key_array)) {
            $key_array[$i] = $val[$key];
            $temp_array[$i] = $val;
        }
        $i++;
    }
    return $temp_array;
}
?>
<section>
    <?php
    $results = search();
    if (!empty($results)) {
        $hasResults = false;
        // remove duplicates
        $results = removeDuplicates($results, 'users_id');
        foreach ($results as $result) {
            // check if there are results
            if (!empty($result)) {
                $hasResults = true;
    ?>
                <a href="/profile?user_id=<?= $result['users_id'] ?>">
                    <article>
                        <img src="<?= file_exists($targetDirImage . 'profile_picture_' . $result['users_id'] . '.jpg') ? '/views/public/images/profile_picture_' . $result['users_id'] . '.jpg' : '/views/public/images/default.png' ?>">
                        <h1>
                            <?= $devmode ? (!empty($user['username']) ? "username: " . $user['username'] . " | " : "") . $result['first_name'] . " " . $result['last_name'] . " <b>isAdmin: " . $result['isAdmin'] . "</b>" : $result['first_name'] . " " . $result['last_name']; ?>
                        </h1>
                        <p>
                            <?= $result['description']; ?>
                        </p>
                    </article>
                </a>
    <?php
            }
        }
        if (!$hasResults) {
            echo "No Results";
        }
    } else {
        echo "No Results";
    }
    ?>
</section>
<?php

require $_SERVER['DOCUMENT_ROOT'] . '/views/partials/footer.php';
