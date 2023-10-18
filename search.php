<?php

$searchTerm = $_GET['q'];
function search($conn)
{
    if (!empty($_GET['q'])) {

        $term = $_GET['q'];

        $users = sqlStatement($conn, "SELECT username FROM users WHERE username LIKE '%" . $term . "%'");
        $hobbies = sqlStatement($conn, "SELECT hobby_name FROM hobbies WHERE hobby_name LIKE '%" . $term . "%'");
    }
    return $returninfo = [
        "users" => $users,
        "hobbies" => $hobbies
    ];
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
