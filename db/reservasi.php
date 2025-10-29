<?php
require_once 'db.php';

class Reservasi
{
    public $id_reservasi;
    public $user_id;
    public $username;
    public $id_meja;
    public $tanggal_reservasi;
    public $waktu_reservasi;
    public $harga_meja;
    public $query;
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function read()
    {
        $query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username 
                  FROM reservasi
                  JOIN user ON reservasi.user_id = user.user_id
                  JOIN meja ON reservasi.id_meja = meja.id_meja
                  ORDER BY id_reservasi DESC";

        $result = $this->db->query($query);

        if (!$result) {
            echo "Error: " . $this->db->error;
            return false;
        }

        return $result;
    }

    public function readAdmin()
    {
        $query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username 
                  FROM reservasi
                  JOIN user ON reservasi.user_id = user.user_id
                  JOIN meja ON reservasi.id_meja = meja.id_meja
                ORDER BY reservasi.id_reservasi DESC";

        $result = $this->db->query($query);

        if (!$result) {
            echo "Error: " . $this->db->error;
            return false;
        }

        return $result;
    }

    public function getReservasiById()
    {
        $query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username 
                  FROM reservasi
                  JOIN user ON reservasi.user_id = user.user_id
                  JOIN meja ON reservasi.id_meja = meja.id_meja
                    WHERE id_reservasi = '{$this->id_reservasi}'";
        return $this->db->query($query);
    }

    public function getReservasiId($id_reservasi)
    {
        $query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username
              FROM reservasi
              JOIN user ON reservasi.user_id = user.user_id
              JOIN meja ON reservasi.id_meja = meja.id_meja
              WHERE reservasi.id_reservasi = '{$id_reservasi}'";

        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }

        return null;
    }
    public function getIdMeja($id_reservasi)
    {
        $query = "SELECT id_meja FROM reservasi WHERE id_reservasi = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_reservasi);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['id_meja'] ?? null;
    }

    public function ReservasiId()
    {
        $query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, meja.harga_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username 
                  FROM reservasi
                  JOIN user ON reservasi.user_id = user.user_id
                  JOIN meja ON reservasi.id_meja = meja.id_meja
                    WHERE id_reservasi = '{$this->id_reservasi}'";
        $result = $this->db->query($query);


        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    public function create()
    {
        $query = "INSERT INTO reservasi (user_id, id_meja, tanggal_reservasi, waktu_reservasi, harga_meja) 
                      VALUES ('{$this->user_id}', '{$this->id_meja}', '{$this->tanggal_reservasi}', '{$this->waktu_reservasi}', '{$this->harga_meja}')";
        return $this->db->query($query);
    }

    public function delete()
    {
        $query = "DELETE FROM reservasi WHERE id_reservasi = '{$this->id_reservasi}'";
        return $this->db->query($query);
    }


    // public function update()
    // {
    //     $query = "UPDATE reservasi SET user_id = '{$this->user_id}', id_meja='{$this->id_meja}', tanggal_reservasi='{$this->tanggal_reservasi}', waktu_reservasi='{$this->waktu_reservasi}', harga_meja='{$this->harga_meja}'";
    //     return $this->db->query($query);
    // }

    public function update()
    {
        $query = "UPDATE reservasi SET user_id = '{$this->user_id}', id_meja = '{$this->id_meja}', tanggal_reservasi = '{$this->tanggal_reservasi}', waktu_reservasi = '{$this->waktu_reservasi}', harga_meja = '{$this->harga_meja}'
              WHERE id_reservasi = '{$this->id_reservasi}'";
        return $this->db->query($query);
    }
}
