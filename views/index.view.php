<?php
// TEST CONNECTION
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// Prepare the sql statement
function sqlStatement($conn, $sql)
{
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<section>
    <?php
    $users = sqlStatement($conn, "SELECT users.username, users.isAdmin FROM users");
    foreach ($users as $user) {
        echo
        "<article><img class='square'><profile><img class='circle'><p>" . $user['username'] . " " . $user['isAdmin'] . "</p><br></article>";
    }
    ?>
</section>
<link rel="stylesheet" href="/views/styles/homepage.css">