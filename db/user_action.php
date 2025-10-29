<?php
require_once 'user.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$action = $_GET['action'];

switch ($action) {
    case 'register':
        $user = new User();
        $user->username = $_POST['username'];
        $user->nama = $_POST['nama'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->alamat = $_POST['alamat'];
        $user->no_telp = $_POST['no_telp'];
    
        if ($user->checkUser()) {
            echo "<script>alert('Username atau email sudah terdaftar. Coba gunakan yang lain.'); history.back();</script>";
        } else {
            if ($user->register()) {
                echo "<script>alert('Akun berhasil dibuat.');</script>";
                header("Location: ../index.php");
                exit();
            } else {
                echo "<script>alert('Registrasi gagal. Coba lagi.'); history.back();</script>";
            }
        }
        break;
    

    /* -------------------------------------------------------------------------- */
    /*                                  user                                      */
    /* -------------------------------------------------------------------------- */

    case 'insert_user':
        $user = new User();
        $user->username = $_POST['username'];
        $user->nama = $_POST['nama'];
        $user->email = $_POST['email'];
        $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user->alamat = $_POST['alamat'];
        $user->no_telp = $_POST['no_telp'];
        $user->role = $_POST['role'];

        if ($user->insertUser()) {
            echo "<script>alert('Akun berhasil dibuat.'); window.location.href='../admin/pages/user.php';</script>";
            exit(); 
        } else {
            echo "<script>alert('Tambah User Gagal. Silahkan Coba lagi.'); history.back();</script>";
        }
    break;

    case 'update':
        $user = new User();
        $user->user_id = $_POST['user_id'];
        $user->username = $_POST['username'];
        $user->nama = $_POST['nama'];
        $user->email = $_POST['email'];
        
        if (!empty($_POST['password'])) {
            $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        } else {    
            $existingUser = $user->userId();
            $user->password = $existingUser['password']; 
        }

        $user->alamat = $_POST['alamat'];
        $user->no_telp = $_POST['no_telp'];
        $user->role = $_POST['role'];
    
        if ($user->update()) {
            echo "<script>alert('Akun berhasil diupdate.'); window.location.href='../admin/pages/user.php';</script>";
        } else {
            echo "<script>alert('Update gagal. Coba lagi.'); history.back();</script>";
        }
    break;

    case 'delete':
        $user = new user;
        $user->user_id = $_GET['user_id'];
        $user->delete();

        if ($user->delete()) {
            echo "<script>alert('Akun berhasil dihapus.'); window.location.href='../admin/pages/user.php';</script>";
        } else {
            echo "<script>alert('Delete gagal. Coba lagi.'); history.back();</script>";
        }
    break;

}
?>
