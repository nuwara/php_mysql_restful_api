<?php

class Database
{
    // db params
    private $server = 'localhost';
     private $db_name = 'test';
    private $username = 'root';
    private $password = '';
    private $conn;

    //db connection
    public function connect()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=$this->server;dbname=$this->db_name", $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo 'Database connected ................';
        } catch (PDOException $e) {
            echo 'Connected Error: ' . $e->getMessage();
        }
        return $this->conn;
    }
}
