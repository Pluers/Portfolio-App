<?php
// Prepare the sql statement
function sqlStatement($conn, $sql)
{
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

/** Method select
 * SELECT based on table and condition provided
 * */
// function select($tbl, $cond = '')
// {
//     $sql = "SELECT * FROM $tbl";
//     if ($cond != '') {
//         $sql .= " WHERE $cond ";
//     }

//     try {
//         $stmt = $conn->prepare($sql);
//         $result = $stmt->fetchAll(); // assuming $result == true
//         return $result;
//     } catch (PDOException $e) {
//         echo 'Error: ' . $e->getMessage();
//     }
// }

// function delete($tbl, $cond = '')
// {
//     $sql = "DELETE FROM `$tbl`";
//     if ($cond != '') {
//         $sql .= " WHERE $cond ";
//     }

//     try {
//         $stmt = $this->conn->prepare($sql);
//         $stmt->execute();
//         return $stmt->rowCount(); // 1
//     } catch (PDOException $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// }

// function insert($tbl, $arr)
// {
//     $sql = "INSERT INTO $tbl (`";
//     $key = array_keys($arr);
//     $val = array_values($arr);
//     $sql .= implode("`, `", $key);
//     $sql .= "`) VALUES ('";
//     $sql .= implode("', '", $val);
//     $sql .= "')";

//     $sql1 = "SELECT MAX( id ) FROM  `$tbl`";
//     try {

//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         $stmt2 = $conn->prepare($sql1);
//         $stmt2->execute();
//         $rows = $stmt2->fetchAll(); // assuming $result == true
//         return $rows[0][0];
//     } catch (PDOException $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// }


// /** Method update
//  * update based on table, array keys and values and the condition
//  * */
// function update($tbl, $arr, $cond)
// {
//     $sql = "UPDATE `$tbl` SET ";
//     $fld = array();
//     foreach ($arr as $k => $v) {
//         $fld[] = "`$k` = '$v'";
//     }
//     $sql .= implode(", ", $fld);
//     $sql .= " WHERE " . $cond;

//     try {
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         return $stmt->rowCount(); // 1
//     } catch (PDOException $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// }

// /** Method softdelet
//  * update based on table, removing created_at value and the condition
//  * */
// function update($tbl, $arr, $cond)
// {
//     $sql = "UPDATE `$tbl` SET created_at IS NULL WHERE " . $cond;

//     try {
//         $stmt = $conn->prepare($sql);
//         $stmt->execute();
//         return $stmt->rowCount(); // 1
//     } catch (PDOException $e) {
//         return 'Error: ' . $e->getMessage();
//     }
// }
