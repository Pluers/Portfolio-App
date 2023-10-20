<?php
function search($conn)
{
    if (!empty($_GET['q'])) {

        $term = $_GET['q'];

        $users = customStatement("SELECT username FROM users WHERE username LIKE '%" . $term . "%'");
        $hobbies = customStatement("SELECT hobby_name FROM hobbies WHERE hobby_name LIKE '%" . $term . "%'");
        $edu = customStatement("SELECT education_name FROM educations WHERE education_name LIKE '%" . $term . "%'");
        $jobexp = customStatement("SELECT company_name, function_name FROM jobexperiences WHERE company_name LIKE '%" . $term . "%' OR function_name LIKE '%" . $term . "%'");
        return [
            "users" => $users,
            "hobbies" => $hobbies,
            "jobexperiences" => $jobexp,
            "educations" => $edu
        ];
    } else return "";
}
if (!empty($_GET['q'])) {
    if (!empty(search($conn)["users"])) {
        echo "<h1>Users</h1>";
        foreach (search($conn)["users"] as $result) {
            foreach ($result as $key) {
                echo $key . "<br>";
            }
        }
    }
    if (!empty(search($conn)["hobbies"])) {
        echo "<h1>Hobbies</h1>";
        foreach (search($conn)["hobbies"] as $result) {
            foreach ($result as $key) {
                echo $key . "<br>";
            }
        }
    }
    if (!empty(search($conn)["educations"])) {
        echo "<h1>Educations</h1>";
        foreach (search($conn)["educations"] as $result) {
            foreach ($result as $key) {
                echo $key . "<br>";
            }
        }
    }
    if (!empty(search($conn)["jobexperiences"])) {
        echo "<h1>Jobs</h1>";
        foreach (search($conn)["jobexperiences"] as $result) {
            foreach ($result as $key) {
                echo $key . " ";
            }
            echo "<br>";
        }
    }
} else {
    echo "No Results";
}
