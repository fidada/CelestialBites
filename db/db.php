<?php 
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $db = "celestial_bites";
    public $conn;
    public $error;

    public function __construct(){
        $this->conn = new mysqli($this->host, $this->user, $this->pass, $this->db);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        return $this->conn->query($sql);
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function close() {
        $this->conn->close();
    }
}
?>
