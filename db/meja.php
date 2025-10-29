<?php
require_once 'db.php';

class Meja
{
    public $id_meja;
    public $harga_meja;
    public $status;
    public $query;
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function read()
    {
        $query = "SELECT * FROM meja";
        return $this->db->query($query);
    }

    public function getMejaById()
    {
        $query = "SELECT * FROM meja WHERE id_meja = '{$this->id_meja}'";
        $result = $this->db->query($query);
        return $result->fetch_assoc(); 
    }
    public function getMeja()
    {
        $query = "SELECT * FROM meja WHERE id_meja = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $this->id_meja);
        $stmt->execute();
        return $stmt->get_result();
    }
    public function HargaMeja($id_meja)
    {
        $query = "SELECT harga_meja FROM meja WHERE id_meja = '{$this->id_meja}'";
        $result = $this->db->query($query);
        return $result->fetch_assoc(); 

    }
    public function getHargaMeja($id_meja)
    {
        $query = "SELECT harga_meja FROM meja WHERE id_meja = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id_meja);  
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['harga_meja'] ?? 0;  
    }


    public function create()
    {
        $query = "INSERT INTO meja (status, harga_meja) 
            VALUES ('{$this->status}', '{$this->harga_meja}')";
        if ($this->db->query($query)) {
            return true;
        } else {
            echo "Error: " . $this->db->error; 
            return false;
        }
    }

    public function update()
    {
        $query = "UPDATE meja SET status = '{$this->status}', harga_meja = '{$this->harga_meja}' WHERE id_meja = '{$this->id_meja}'";
        error_log("Executing query: " . $query);
        $result = $this->db->query($query);
        if (!$result) {
            error_log("Query failed: " . $this->db->error);
            return false;
        }
        return true;
    }


    public function delete()
    {
        $query = "DELETE FROM meja WHERE id_meja = '{$this->id_meja}'";
        return $this->db->query($query);
    }
}
