<?php
// Prepare the sql statement

function customStatement($sql, $params = [])
{
    global $conn;

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

/* Select Method
 * SELECT based on table and condition provided
 * */
function select($var, $table, $cond = '')
{
    global $conn;
    $sql = "SELECT $var FROM $table";
    if ($cond != '') {
        $sql .= " WHERE $cond";
    }

    try {
        $stmt = $conn->prepare($sql);
        $result = $stmt->fetchAll();
        return $result;
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

function harddel($table, $cond = '')
{
    global $conn;
    $sql = "DELETE FROM $table";
    if ($cond != '') {
        $sql .= " WHERE $cond ";
    }

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // 1
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

function insert($table, $array)
{
    global $conn;
    $sql = "INSERT INTO $table (`";
    $key = array_keys($array);
    $val = array_values($array);
    $sql .= implode("`, `", $key);
    $sql .= "`) VALUES ('";
    $sql .= implode("', '", $val);
    $sql .= "')";

    $sql1 = "SELECT MAX( $table . '_' . id ) FROM  `$table`";
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $stmt2 = $conn->prepare($sql1);
        $stmt2->execute();
        $rows = $stmt2->fetchAll(); // assuming $result == true
        return $rows[0][0];
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}

/* Method update
 * update based on table, array keys and values and the condition
 * */
function update($table, $array, $cond)
{
    global $conn;
    $sql = "UPDATE $table SET ";
    $fld = array();
    foreach ($array as $k => $v) {
        $fld[] = "`$k` = '$v'";
    }
    $sql .= implode(", ", $fld);
    $sql .= " WHERE " . $cond;

    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // 1
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}
/** Method softdelet
 * update based on table, removing created_at value and the condition
 * */
function softdel($table, $cond)
{
    global $conn;

    $sql = "UPDATE $table SET created_at IS NULL WHERE " . $cond;
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->rowCount(); // 1
    } catch (PDOException $e) {
        return 'Error: ' . $e->getMessage();
    }
}
