<?php

$searchTerm = $_GET['q'];
function search($conn)
{
    if (!empty($_GET['q'])) {

        $term = $_GET['q'];

        $sql = "SELECT * FROM users WHERE username LIKE '%" . $term . "%'";
        $r_query = sqlStatement($conn, $sql);
    }
    return $r_query;
}
foreach (search($conn) as $result) {

    foreach ($result as $key) {
        echo $key . "<br>";
    }
}
