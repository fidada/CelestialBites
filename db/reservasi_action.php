<?php


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'reservasi.php';
require_once 'user.php';
require_once 'meja.php';
require_once 'transaksi.php';
session_start();

$action = $_GET['action'] ?? '';

switch ($action) {

        /* -------------------------------------------------------------------------- */
        /*                                  customer                                  */
        /* -------------------------------------------------------------------------- */

    case 'insert_customer':
    case 'insert':
        $reservasi = new Reservasi();
        $user = new User();
        $meja = new Meja();  

        $username = $_POST['username'] ?? '';
        $user->username = $username;
        $result = $user->getUserByUsername();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];

            
            $meja->id_meja = $_POST['id_meja'];
            $mejaResult = $meja->getMeja();
            if ($mejaResult && $mejaRow = $mejaResult->fetch_assoc()) {
                if ($mejaRow['status'] == 'tidak tersedia') {
                    echo "<script>alert('Meja tidak tersedia, silahkan pilih meja lain'); history.back();</script>";
                    exit;
                }
            } else {
                echo "<script>alert('Error: Meja tidak ditemukan'); history.back();</script>";
                exit;
            }

            $reservasi->user_id = $user_id;
            $reservasi->id_meja = $_POST['id_meja'];
            $reservasi->tanggal_reservasi = $_POST['tanggal_reservasi'];
            $reservasi->waktu_reservasi = $_POST['waktu_reservasi'];
            $reservasi->harga_meja = $_POST['harga_meja'];

            $result = $reservasi->create();

            if ($result) {
                $_SESSION['id_reservasi'] = $reservasi->db->conn->insert_id;
                $_SESSION['id_meja'] = $reservasi->id_meja;
                $_SESSION['username'] = $username;

                $redirectUrl = $action == 'insert_customer' ? '../pages/transaksi.php' : '../admin/pages/reservasi.php';
                echo "<script>alert('Reservasi Berhasil.'); window.location.href='$redirectUrl';</script>";
            } else {
                echo "<script>alert('Gagal membuat reservasi'); history.back();</script>";
            }
        } else {
            echo "<script>alert('Nama Tidak Terdaftar. Silahkan Masukkan Nama yang Sudah Terdaftar atau Register Akun.'); history.back();</script>";
        }
        break;

    case 'update':
        $reservasi = new Reservasi();
        $user = new User();
        $meja = new Meja();  

        $username = $_POST['username'] ?? '';
        $user->username = $username;
        $result = $user->getUserByUsername();

        $harga_meja = $_POST['harga_meja'] ?? null;
        if ($harga_meja === null) {
            echo "<script>alert('Harga meja is not set.'); history.back();</script>";
            exit;
        }

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $user_id = $row['user_id'];

            $reservasi->user_id = $user_id;
            $reservasi->id_reservasi = $_POST['id_reservasi'];
            $reservasi->id_meja = $_POST['id_meja'];
            $reservasi->tanggal_reservasi = $_POST['tanggal_reservasi'];
            $reservasi->waktu_reservasi = $_POST['waktu_reservasi'];
            $reservasi->harga_meja = $harga_meja;

            $result = $reservasi->update();

            if ($result) {
                $_SESSION['id_reservasi'] = $reservasi->id_reservasi;
                $_SESSION['id_meja'] = $reservasi->id_meja;
                $_SESSION['username'] = $username;

                echo "<script>alert('Reservasi Berhasil Diupdate.'); window.location.href='../admin/pages/reservasi.php';</script>";
            } else {
                echo "<script>alert('Gagal memperbarui reservasi.'); history.back();</script>";
            }
        } else {
            echo "<script>alert('Nama Tidak Terdaftar. Silahkan Masukkan Nama yang Sudah Terdaftar atau Register Akun.'); history.back();</script>";
        }
        break;


    case 'delete':
        $reservasi = new Reservasi();
        $reservasi->id_reservasi = $_GET['id_reservasi'];


        $transaksi = new Transaksi();
        $transaksi->id_reservasi = $reservasi->id_reservasi;
        $resultTransaksi = $transaksi->getByReservasiId();


        if ($resultTransaksi->num_rows > 0) {
            $row = $resultTransaksi->fetch_assoc();
            $id_transaksi = $row['id_transaksi'];

            echo "<script>alert('Reservasi gagal dihapus karena masih ada transaksi yang terkait. ID Transaksi: $id_transaksi'); history.back();</script>";
        } else {

            $result = $reservasi->delete();
            if ($result) {
                echo "<script>alert('Reservasi Berhasil Dihapus.'); history.back();</script>";
            } else {
                echo "<script>alert('Reservasi gagal dihapus.'); history.back();</script>";
            }
        }
        break;


    default:
        echo "<script>alert('Invalid action.'); history.back();</script>";
        break;
}
