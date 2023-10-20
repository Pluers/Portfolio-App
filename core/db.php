<?php
class dbConnection
{
    public $info, $dbconn, $hostname, $dbname, $username, $password, $devmode, $conn;
    public function db()
    {
        $info = parse_ini_file("env.ini", true);
        $this->info = $info;
        $this->dbconn = $info['database'];
        $this->hostname = $info['database']['servername'];
        $this->username = $info['database']['username'];
        $this->password = $info['database']['drowssap'];
        $this->dbname = $info['database']['dbname'];
        $this->devmode = $info['settings']['developer_mode'];

        // TEST CONNECTION
        try {
            $conn = new PDO("mysql:host=$this->hostname;dbname=$this->dbname", $this->username, $this->password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if ($this->devmode) echo "Connection successful";
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
}
