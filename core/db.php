<?php
class Connection
{
    public PDO $conn;

    function __construct($servername, $dbname, $username, $drowssap) {
        try {
            $this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $drowssap);
            $this->conn->setAttribute( PDO::ERRMODE_EXCEPTION, PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}