<?php
function search($conn)
{
    if (!empty($_GET['q'])) {

        $term = $_GET['q'];

        $users = sqlStatement($conn, "SELECT username FROM users WHERE username LIKE '%" . $term . "%'");
        $hobbies = sqlStatement($conn, "SELECT hobby_name FROM hobbies WHERE hobby_name LIKE '%" . $term . "%'");
        return [
            "users" => $users,
            "hobbies" => $hobbies
        ];
    } else return " ";
}
if (!empty($_GET['q'])) {
    echo "<h1>Users</h1>";
    foreach (search($conn)["users"] as $result) {
        foreach ($result as $key) {
            echo $key . "<br>";
        }
    }
    echo "<h1>Hobbies</h1>";
    foreach (search($conn)["hobbies"] as $result) {
        foreach ($result as $key) {
            echo $key . "<br>";
        }
    }
}
