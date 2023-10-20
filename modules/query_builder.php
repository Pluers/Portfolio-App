<?php
class QueryBuilder
{
    // Start connection
    public $conn;
    public function __construct($conn)
    {
        $this->conn = $conn->conn;
    }
    // Prepare the sql statement
    function customStatement($sql)
    {
        // if ($devmode) echo "conn = " . var_export($this->conn, true);

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}
