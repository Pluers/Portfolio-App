<?php
// if (isset($_POST['delete_hobby'])) {
//     customStatement(
//         'DELETE FROM educations WHERE hobbies_id = :hobbies_id',
//         [':hobbies_id' => (int)$_POST['hobbiesList']]
//     );
// }



redirect('/editprofile?tab=educations&user_id=' . $user_id);
