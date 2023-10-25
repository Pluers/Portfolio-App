<?php
function search()
{
    if (!empty($_GET['q'])) {
        // zorg dat je geen speciale charaters kan gebruiken
        $term = getSanitizedStr($_GET['q']);

        $users = customStatement("SELECT username FROM users WHERE username LIKE '%" . $term . "%'");
        $hobbies = customStatement("SELECT hobby_name FROM hobbies WHERE hobby_name LIKE '%" . $term . "%'");
        $edu = customStatement("SELECT education_name FROM educations WHERE education_name LIKE '%" . $term . "%'");
        $jobexp = customStatement("SELECT company_name, function_name FROM jobexperiences WHERE company_name LIKE '%" . $term . "%' OR function_name LIKE '%" . $term . "%'");
        // return alle waardes zodat je ze in de view kan gebruiken
        return [
            "Users" => $users,
            "Hobbies" => $hobbies,
            "Jobs" => $jobexp,
            "Educations" => $edu
        ];
    }
}
require $_SERVER['DOCUMENT_ROOT'] . '/views/search.view.php';
