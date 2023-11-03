<?php
require $_SERVER['DOCUMENT_ROOT'] . '/views/search.view.php';

function search()
{
    // zorg dat je geen speciale characters kan gebruiken
    $term = isset($_GET['q']) ? getSanitizedStr($_GET['q']) : '';

    // haal alle users op en de users die een hobby hebben die overeen komt met de zoekterm
    $usersFromSearch = customStatement(
        'SELECT users.* FROM users
LEFT JOIN user_hobbies on user_hobbies.users_id = users.users_id
LEFT JOIN hobbies on user_hobbies.hobbies_id = hobbies.hobbies_id
LEFT JOIN user_jobexperiences uj ON uj.users_id = users.users_id
LEFT JOIN jobexperiences ON jobexperiences.jobexperiences_id = uj.jobexperiences_id
LEFT JOIN user_education ON user_education.users_id = users.users_id
LEFT JOIN educations ON educations.educations_id = user_education.educations_id
WHERE users.first_name LIKE :searchterm
   OR users.last_name LIKE :searchterm
   OR hobbies.hobby_name LIKE :searchterm
   OR educations.education_name LIKE :searchterm
   OR jobexperiences.job_title LIKE :searchterm
   OR jobexperiences.company_name LIKE :searchterm
ORDER BY users.first_name ASC',
        [':searchterm' => '%' . $term . '%']
    );

    return $usersFromSearch;
}
