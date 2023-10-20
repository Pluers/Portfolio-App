<?php
// Prepare the sql statement

function sqlStatement($sql)
{
    global $devmode, $conn;
    if ($devmode) echo "conn = " . var_export($conn, true);
    if ($devmode && $conn == null) {
        echo "Error: database connection is null";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
