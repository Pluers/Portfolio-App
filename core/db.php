<?php

// database connection
class Connection
{
    public PDO $conn;

    function __construct($servername, $dbname, $username, $drowssap)
    {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $drowssap);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $this->conn = $conn;
        } catch (PDOException $e) {
            if ($e->getCode() == 1049) {
                $conn = new PDO("mysql:host=$servername", $username, $drowssap);
                $sql = "CREATE SCHEMA IF NOT EXISTS $dbname DEFAULT CHARACTER SET utf8";
                $conn->exec($sql);
                $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $drowssap);
                $file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/core/script.sql', FALSE, NULL);

                // Remove comments from the SQL script
                $file = preg_replace('/--.*(\r?\n|$)/', '', $file);

                // Split the SQL script into individual statements
                $sqlStatements = explode(';', $file);

                foreach ($sqlStatements as $statement) {
                    $statement = trim($statement);
                    // Skip empty lines
                    if ($statement) {
                        $conn->exec($statement);
                    }
                }

                $this->conn = $conn;
            } else {
                echo 'Error: ' . $e->getMessage();
            }
        }
    }
}
