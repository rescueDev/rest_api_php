<?php
class Database
{
    private $host = 'localhost';
    private $db_name = 'myLibrary';
    private $username = 'root';
    private $password = 'liesina92';
    private $conn;

    public function create()
    {
        try {
            $this->conn = new PDO('mysql:host=' . $this->host, $this->username, $this->password);
            $sql = file_get_contents("data/init.sql");
            $this->conn->exec($sql);
            echo "Database and table users created successfully.";
        } catch (PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }

    public function connect()
    {
        $this->conn = null;

        try {
            $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection Error: ' . $e->getMessage();
        }

        return $this->conn;
    }
}
