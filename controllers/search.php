<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/search.view.php';
function search()
{
    if (!empty($_GET['q'])) {
        // zorg dat je geen speciale charaters kan gebruiken
        $term = getSanitizedStr($_GET['q']);

        $users = customStatement('SELECT first_name, last_name FROM users WHERE first_name LIKE :searchterm OR last_name LIKE :searchterm', [':searchterm' => '%' . $term . '%']);
        $hobbies = customStatement('SELECT hobby_name FROM hobbies WHERE hobby_name LIKE :searchterm', [':searchterm' => '%' . $term . '%']);
        $edu = customStatement('SELECT education_name FROM educations WHERE education_name LIKE :searchterm', [':searchterm' => '%' . $term . '%']);
        $jobexp = customStatement('SELECT company_name, job_title FROM jobexperiences WHERE company_name LIKE :searchterm OR job_title LIKE :searchterm', [':searchterm' => '%' . $term . '%']);
        // return alle waardes zodat je ze in de view kan gebruiken
        return [
            "Users" => $users,
            "Hobbies" => $hobbies,
            "Jobs" => $jobexp,
            "Educations" => $edu
        ];
    }
}

