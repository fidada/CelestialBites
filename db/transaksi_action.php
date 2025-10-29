<?php
require_once 'transaksi.php';
require_once 'produk.php';
require_once 'reservasi.php';
require_once 'meja.php';
require_once 'db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$action = $_GET['action'];

switch ($action) {
    case 'insert':
        $transaksi = new Transaksi();
        $meja = new Meja();
        $produk = new Produk();
        $reservasi = new Reservasi();

        $id_reservasi = $_SESSION['id_reservasi'];
        $id_meja = $_SESSION['id_meja'];
        $harga_meja = $meja->getHargaMeja($id_meja);

        if (!$harga_meja) {
            die("Error: Harga meja tidak ditemukan.");
        }

        $total_transaksi = $harga_meja;
        $all_products = [];

        foreach ($_POST['jumlah_pesanan'] as $id_produk => $jumlah) {
            if ($jumlah > 0) {
                $harga_produk = $_POST['harga_produk'][$id_produk];
                $subtotal = $jumlah * $harga_produk;
                $total_transaksi += $subtotal;

                $nama_produk = $produk->getProduk($id_produk);

                $all_products[] = [
                    'id_produk' => $id_produk,
                    'nama_produk' => $nama_produk,
                    'jumlah' => $jumlah,
                    'harga' => $harga_produk,
                    'subtotal' => $subtotal
                ];

                
                $transaksi->id_reservasi = $id_reservasi;
                $transaksi->id_produk = $id_produk;
                $transaksi->jumlah_pesanan = $jumlah;
                $transaksi->subtotal = $subtotal;

                if (!$transaksi->create()) {
                    echo "Error: Transaksi gagal disimpan untuk produk ID: $id_produk<br>";
                    echo "Database Error: " . $transaksi->db->error;
                }
            }
        }

        
        $_SESSION['products'] = $all_products;
        $_SESSION['total_transaksi'] = $total_transaksi;
        $_SESSION['harga_meja'] = $harga_meja;

        echo "<script>alert('Transaksi Berhasil.'); window.location.href='../pages/struk.php';</script>";
        exit();

    
}