<?php
require_once 'produk.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$action = $_GET['action'];
switch ($action) {
    case 'insert':
        $produk = new Produk();
        $produk->nama_produk = $_POST['nama_produk'];
        $produk->kategori = $_POST['kategori'];
        $produk->harga_produk = $_POST['harga_produk'];

        if (!isset($_FILES['gambar_produk']) || $_FILES['gambar_produk']['error'] !== UPLOAD_ERR_OK) {
            echo "File upload error: " . ($_FILES['gambar_produk']['error'] ?? 'No file uploaded');
            exit;
        }

        $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/celestial_bitess/img/card/';
        $file_name = uniqid() . '_' . basename($_FILES['gambar_produk']['name']);
        $upload_file = $upload_dir . $file_name;
        if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $upload_file)) {
            $produk->gambar_produk = $file_name;

            if ($produk->create()) {
                echo "<script>alert('Produk Berhasil Ditambah.'); window.location.href='../admin/pages/produk.php';</script>";
                exit();
            } else {
                echo "<script>alert('Produk gagal ditambah.'); history.back();</script>";
            }
        } else {
            echo "Failed to upload file.<br>";
            echo "PHP error: " . error_get_last()['message'] . "<br>";
        }
        break;

        case 'update':
            $produk = new Produk();
            $produk->id_produk = $_POST['id_produk'];
            $produk->nama_produk = $_POST['nama_produk'];
            $produk->kategori = $_POST['kategori'];
            $produk->harga_produk = $_POST['harga_produk'];
        
            if (isset($_FILES['gambar_produk']) && $_FILES['gambar_produk']['error'] === UPLOAD_ERR_OK) {
                $upload_dir = $_SERVER['DOCUMENT_ROOT'] . '/celestial_bitess/img/card/';
                $file_name = uniqid() . '_' . basename($_FILES['gambar_produk']['name']);
                $upload_file = $upload_dir . $file_name;
        
                if (move_uploaded_file($_FILES['gambar_produk']['tmp_name'], $upload_file)) {
                    $produk->gambar_produk = $file_name;
                } else {
                    echo "Gagal mengunggah file.<br>";
                    echo "PHP error: " . error_get_last()['message'] . "<br>";
                    exit();
                }
            } else {
                $produk->gambar_produk = $_POST['gambar_produk_lama'];
            }
        
            if ($produk->update()) {
                echo "<script>alert('Produk Berhasil Diedit.'); window.location.href='../admin/pages/produk.php';</script>";
            } else {
                echo "<script>alert('Produk gagal diedit.'); history.back();</script>";
            }
            exit();
        // break;
        

        case 'delete':
            $produk = new produk;
            $produk->id_produk = $_GET['id_produk'];
            $produk->delete();
    
        
            if ($produk->delete()) {
                echo "<script>alert('Produk Berhasil Dihapus.'); history.back();</script>";
            } else {
                echo "<script>alert('Produk gagal dihapus.'); history.back();</script>";
            }
        break;
}
