<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/search.view.php';
function search()
{
    if (!empty($_GET['q'])) {
        // sanitize the input
        $term = getSanitizedStr($_GET['q']);

        // execute the query
        $users = customStatement('SELECT * FROM users JOIN hobbies, educations, jobexperiences WHERE users.first_name LIKE :searchterm OR users.last_name LIKE :searchterm OR hobbies.hobby_name LIKE :searchterm OR educations.education_name LIKE :searchterm OR jobexperiences.job_title LIKE :searchterm OR jobexperiences.company_name LIKE :searchterm ORDER BY users.first_name ASC', [':searchterm' => '%' . $term . '%']);
        // return the result
        return $users;
    }
}
