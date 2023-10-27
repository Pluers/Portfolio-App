<?php
function search()
{
    if (!empty($_GET['q'])) {
        // zorg dat je geen speciale charaters kan gebruiken
        $term = getSanitizedStr($_GET['q']);

        $users = customStatement("SELECT username FROM users WHERE username LIKE :searchterm", [':searchterm' => '%' . $term . '%']);
        $hobbies = customStatement("SELECT hobby_name FROM hobbies WHERE hobby_name LIKE :searchterm", [':searchterm' => '%' . $term . '%']);
        $edu = customStatement("SELECT education_name FROM educations WHERE education_name LIKE :searchterm", [':searchterm' => '%' . $term . '%']);
        $jobexp = customStatement("SELECT company_name, function_name FROM jobexperiences WHERE company_name LIKE :searchterm OR function_name LIKE :searchterm", [':searchterm' => '%' . $term . '%']);
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
