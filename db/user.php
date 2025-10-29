<?php
require_once 'db.php';

class User
{
    public $user_id;
    public $username;
    public $nama;
    public $email;
    public $password;
    public $alamat;
    public $no_telp;
    public $role;
    public $query;
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function read()
    {
        $query = "SELECT * FROM user";
        return $this->db->query($query);
    }
    public function readCust()
    {
        $query = "SELECT * FROM user WHERE role = 'customer'";
        return $this->db->query($query);
    }

    public function getUserById()
    {
        $query = "SELECT * FROM user WHERE user_id = '{$this->user_id}'";
        return $this->db->query($query);
    }

    public function userId()
    {
        $query = "SELECT * FROM user WHERE user_id = '{$this->user_id}'";
        $result = $this->db->query($query);


        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    public function register()
    {
        $query = "INSERT INTO user (username, nama, email, password, alamat, no_telp, role) 
            VALUES ('{$this->username}', '{$this->nama}', '{$this->email}', '{$this->password}', '{$this->alamat}', '{$this->no_telp}', 'customer')";
        return $this->db->query($query);
    }

    public function checkUser()
    {
        $query = "SELECT * FROM user WHERE username = ? OR email = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $this->username, $this->email);
        $stmt->execute();
        $result = $stmt->get_result();

        return $result->num_rows > 0;
    }


    public function insertUser()
    {
        $query = "INSERT INTO user (username, nama, email, password, alamat, no_telp, role) 
            VALUES ('{$this->username}', '{$this->nama}', '{$this->email}', '{$this->password}', '{$this->alamat}', '{$this->no_telp}', '{$this->role}')";
        return $this->db->query($query);
    }


    public function delete()
    {
        $query = "DELETE FROM user WHERE user_id = '{$this->user_id}'";
        return $this->db->query($query);
    }

    public function update()
    {
        $query = "UPDATE user SET 
        username = '{$this->username}', 
        nama = '{$this->nama}', 
        email = '{$this->email}', 
        password = '{$this->password}', 
        alamat = '{$this->alamat}', 
        no_telp = '{$this->no_telp}', 
        role = '{$this->role}' 
        WHERE 
        user_id = '{$this->user_id}'";

        return $this->db->query($query);
    }

    public function getUserByUsername()
    {
        $query = "SELECT user_id FROM user WHERE username = '{$this->username}'";
        return $this->db->query($query);
    }
}
