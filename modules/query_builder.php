<?php
// Prepare the sql statement

function sqlStatement($conn, $sql)
{
    $devmode = parse_ini_file("env.ini", true)['settings']['developer_mode'];
    if ($devmode) echo "conn = " . var_export($conn, true);

    if ($conn == null) {
        echo "Error: database connection is null";
        return null;
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
