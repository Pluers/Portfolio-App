<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // collect value of input field
    $data = $_REQUEST['changeHobby'];

    if (empty($data)) {
        echo "data is empty";
    } else {
        echo $data;
        $userid = $_SESSION['userid'] = 1;
        sqlStatement($conn, "insert into hobbies (users_id, hobby_name) value ( $userid , '$data')");
    }
}
