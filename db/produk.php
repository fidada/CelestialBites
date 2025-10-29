<?php
require_once 'db.php';

class Produk
{
    public $id_produk;
    public $nama_produk;
    public $kategori;
    public $harga_produk;
    public $gambar_produk;
    public $gambar;
    public $query;
    public $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function read()
    {
        $query = "SELECT * FROM produk ORDER BY id_produk desc";
        return $this->db->query($query);
    }

    public function produkMakanan()
    {
        $query = "SELECT * FROM produk WHERE kategori = 'makanan'";
        return $this->db->query($query);
    }
    public function produkMinuman()
    {
        $query = "SELECT * FROM produk WHERE kategori = 'minuman'";
        return $this->db->query($query);
    }

    public function getProdukById()
    {
        $query = "SELECT * FROM produk WHERE id_produk = '{$this->id_produk}'";
        return $this->db->query($query);
    }

    public function ProdukId()
    {
        $query = "SELECT * FROM produk WHERE id_produk = '{$this->id_produk}'";
        $result = $this->db->query($query);


        if ($result && $row = $result->fetch_assoc()) {
            return $row;
        }
        return null;
    }

    public function getProdukName($id_produk)
    {
        $query = "SELECT nama_produk FROM produk WHERE id_produk = '{$id_produk}'";
        $result = $this->db->query($query);

        if ($result && $row = $result->fetch_assoc()) {
            return $row['nama_produk'];
        }
        return null;
    }

    public function getProdukByName($id_produk)
    {

        if (is_array($id_produk)) {
            $id_produk = implode(',', $id_produk);
        }
        $query = "SELECT id_produk, nama_produk FROM produk WHERE id_produk IN ({$id_produk})";
        $result = $this->db->query($query);

        $produk_nama = [];
        while ($row = $result->fetch_assoc()) {
            $produk_nama[$row['id_produk']] = $row['nama_produk'];
        }
        return $produk_nama;
    }

    public function getHargaProduk()
    {

        $query = "SELECT harga_produk FROM produk WHERE id_produk = '{$this->id_produk}'";
        $result = $this->db->query($query);


        return $result->fetch_assoc();
    }

    public function HargaProduk($id_produk)
    {
        $query = "SELECT harga_produk FROM produk WHERE id_produk = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        return $row['harga_produk'] ?? null;
    }

    public function create()
    {
        $query = "INSERT INTO produk (nama_produk, kategori, harga_produk, gambar_produk) 
        VALUES (?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssds", $this->nama_produk, $this->kategori, $this->harga_produk, $this->gambar_produk);
        return $stmt->execute();
    }

    public function update()
    {
        $query = "UPDATE produk 
              SET nama_produk = '{$this->nama_produk}', 
                  kategori = '{$this->kategori}', 
                  harga_produk = '{$this->harga_produk}', 
                  gambar_produk = '{$this->gambar_produk}' 
              WHERE id_produk = '{$this->id_produk}'";

        return $this->db->query($query);
    }


    public function delete()
    {
        $query = "DELETE FROM produk WHERE id_produk = '{$this->id_produk}'";
        return $this->db->query($query);
    }

    public function getProduk($id_produk)
    {
        $query = "SELECT nama_produk FROM produk WHERE id_produk = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id_produk);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();


        if ($row) {
            return $row['nama_produk'];
        } else {
            return 'Produk tidak ditemukan';
        }
    }
}
