<?php

$hobbies = customStatement("SELECT hobby_name FROM hobbies");
$educations = customStatement("SELECT education_name FROM educations");
$jobexperiences = customStatement("SELECT company_name, function_name FROM jobexperiences");

require $_SERVER['DOCUMENT_ROOT'] . '/views/base.view.php';
