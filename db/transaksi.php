<?php
require_once 'db.php';

class Transaksi
{
    public $id_transaksi;
    public $id_reservasi;
    public $id_produk;
    public $jumlah_pesanan;
    public $subtotal;
    public $username;
    public $query;
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function read()
    {
        $query = "SELECT 
                transaksi.id_transaksi, 
                reservasi.harga_meja, 
                reservasi.tanggal_reservasi, 
                produk.nama_produk, 
                transaksi.jumlah_pesanan, 
                transaksi.subtotal, 
                user.username,          
                reservasi.id_meja       
              FROM transaksi
              JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
              JOIN produk ON transaksi.id_produk = produk.id_produk
              JOIN user ON reservasi.user_id = user.user_id  
              JOIN meja ON reservasi.id_meja = meja.id_meja";

        $result = $this->db->query($query);
        if (!$result) {
            echo "Query error: " . $this->db->error;
            return null;
        }
        return $result;
    }

    public function readAdmin()
    {
        $query = "SELECT 
                transaksi.id_transaksi, 
                transaksi.id_reservasi, 
                reservasi.harga_meja, 
                reservasi.tanggal_reservasi, 
                produk.nama_produk, 
                transaksi.jumlah_pesanan, 
                transaksi.subtotal, 
                user.username,          
                reservasi.id_meja       
              FROM transaksi
              JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
              JOIN produk ON transaksi.id_produk = produk.id_produk
              JOIN user ON reservasi.user_id = user.user_id  
              JOIN meja ON reservasi.id_meja = meja.id_meja
              ORDER BY id_transaksi DESC";

        $result = $this->db->query($query);
        if (!$result) {
            echo "Query error: " . $this->db->error;
            return null;
        }
        return $result;
    }

    public function getTransaksiById()
    {
        $query = "SELECT * FROM transaksi WHERE id_transaksi = '{$this->id_transaksi}'";
        $result = $this->db->query($query);

        return $result->fetch_assoc();
    }

    public function transaksiId()
    {
        $query = "SELECT 
                transaksi.id_transaksi, 
                reservasi.harga_meja, 
                reservasi.tanggal_reservasi, 
                produk.nama_produk, 
                transaksi.jumlah_pesanan, 
                transaksi.subtotal,
                transaksi.id_reservasi, 
                transaksi.id_produk, 
                user.username,          
                reservasi.id_meja       
              FROM transaksi
              JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
              JOIN produk ON transaksi.id_produk = produk.id_produk
              JOIN user ON reservasi.user_id = user.user_id  
              JOIN meja ON reservasi.id_meja = meja.id_meja 
              WHERE id_transaksi = '{$this->id_transaksi}'";
        $result = $this->db->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
        return null; 
    }

    public function getByReservasiId() {
        $query = "SELECT * FROM transaksi WHERE id_reservasi = '{$this->id_reservasi}'";
        return $this->db->query($query);
    }

    /* -------------------------------------------------------------------------- */
    /*                                    CRUD                                    */
    /* -------------------------------------------------------------------------- */

    public function create()
    {
        $query = "INSERT INTO transaksi (id_reservasi, id_produk, jumlah_pesanan, subtotal) 
              VALUES (?, ?, ?, ?)";

        $stmt = $this->db->conn->prepare($query);

        if (!$stmt) {
            echo "Prepare failed: (" . $this->db->conn->errno . ") " . $this->db->conn->error;
            return false;
        }

        $stmt->bind_param("iidi", $this->id_reservasi, $this->id_produk, $this->jumlah_pesanan, $this->subtotal);

        if ($stmt->execute()) {
            return true;
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
    }
    

    public function update()
    {
        $query = "UPDATE transaksi SET 
                    id_reservasi = ?, 
                    id_produk = ?, 
                    jumlah_pesanan = ?, 
                    subtotal = ? 
                  WHERE id_transaksi = ?";

        $stmt = $this->db->conn->prepare($query);

        if (!$stmt) {
            echo "Prepare failed: (" . $this->db->conn->errno . ") " . $this->db->conn->error;
            return false;
        }

        
        $stmt->bind_param("iidii", $this->id_reservasi, $this->id_produk, $this->jumlah_pesanan, $this->subtotal, $this->id_transaksi);

        
        if ($stmt->execute()) {
            return true;
        } else {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            return false;
        }
    }

    public function delete()
    {
        $query = "DELETE FROM transaksi WHERE id_transaksi = '{$this->id_transaksi}'";
        return $this->db->query($query);
    }
}
