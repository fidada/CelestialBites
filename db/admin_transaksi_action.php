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

        $id_reservasi = $_POST['id_reservasi'];
        $id_produk = $_POST['id_produk'];
        $jumlah_pesanan = $_POST['jumlah_pesanan'];

        $harga_produk = $produk->HargaProduk($id_produk);

        if (!$harga_produk) {
            die("Error: Harga produk tidak ditemukan.");
        }

        $reservasiData = $reservasi->getReservasiId($id_reservasi);
        if (!$reservasiData) {
            die("Error: Data reservasi tidak ditemukan untuk ID reservasi: " . $id_reservasi . " id meja: $id_meja");
        }

        $subtotal = $jumlah_pesanan * $harga_produk;
        $total_transaksi = $reservasiData['harga_meja'] + $subtotal;

        $transaksi->id_reservasi = $id_reservasi;
        $transaksi->id_produk = $id_produk;
        $transaksi->jumlah_pesanan = $jumlah_pesanan;
        $transaksi->subtotal = $total_transaksi;

        if ($transaksi->create()) {
            echo "<script>alert('Transaksi Berhasil.'); window.location.href='../admin/pages/transaksi.php';</script>";
        } else {
            echo "Error: Transaksi gagal disimpan.";
            echo "Database Error: " . $transaksi->db->error;
        }
        exit();

    case 'update':
        $transaksi = new Transaksi();
        $produk = new Produk();
        $reservasi = new Reservasi();

        $id_transaksi = $_POST['id_transaksi'] ?? null;
        $id_reservasi = $_POST['id_reservasi'] ?? null;
        $id_produk = $_POST['id_produk'] ?? null;
        $jumlah_pesanan = $_POST['jumlah_pesanan'] ?? null;

        if (!$id_reservasi || !$id_produk || !$jumlah_pesanan) {
            die("Error: Missing required data for update. id_reservasi:  $id_reservasi | id prodduk:  $id_produk | jumlah: $jumlah_pesanan");
        }

        $harga_produk = $produk->HargaProduk($id_produk);
        if ($harga_produk === false || $harga_produk === null) {
            die("Error: Harga produk tidak ditemukan untuk ID produk: " . $id_produk);
        }

        $reservasiData = $reservasi->getReservasiId($id_reservasi);
        if (!$reservasiData) {
            die("Error: Data reservasi tidak ditemukan untuk ID reservasi: " . $id_reservasi . " id meja: $id_meja");
        }

        $subtotal = $jumlah_pesanan * $harga_produk;
        $total_transaksi = $reservasiData['harga_meja'] + $subtotal;


        $transaksi->id_transaksi = $id_transaksi;
        $transaksi->id_reservasi = $id_reservasi;
        $transaksi->id_produk = $id_produk;
        $transaksi->jumlah_pesanan = $jumlah_pesanan;
        $transaksi->subtotal = $total_transaksi;

        

        if ($transaksi->update()) {
            echo "<script>alert('Transaksi berhasil diupdate.'); window.location.href='../admin/pages/transaksi.php';</script>";
        } else {
            echo "Error: Transaksi gagal diupdate. ";
            echo "Database Error: " . $transaksi->db->error;
        }
        exit();

        case 'delete':
            $transaksi = new Transaksi();
            $transaksi->id_transaksi = $_GET['id_transaksi'];
            $transaksi->delete();
    
    
            if ($transaksi->delete()) {
                echo "<script>alert('Transaksi berhasil dihapus.');history.back();</script>";
            } else {            
                echo "<script>alert('Transaksi gagal diupdate.'); history.back();</script>";
            }
            break;
}
