<?php
require_once 'meja.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$action = $_GET['action'];
switch ($action) {
    case 'insert':
        $meja = new meja();
        $meja->status = $_POST['status'];
        $meja->harga_meja = $_POST['harga_meja'];

        if ($meja->create()) {
            header("Location: ../admin/pages/meja.php");
            exit();
        } else {
            echo "<script>alert('Gagal.'); history.back();</script>";
        }
        break;

        case 'update':
            $meja = new Meja();
            $meja->id_meja = $_POST['id_meja'];
            $meja->status = $_POST['status'];
            $meja->harga_meja = $_POST['harga_meja'];
        
            error_log("Received data - ID: {$meja->id_meja}, Status: {$meja->status}, Harga: {$meja->harga_meja}");
        
            if ($meja->update()) {
                echo "<script>alert('Meja berhasil diedit.'); window.location.href='../admin/pages/meja.php';</script>";
                exit;
            } else {
                echo "<script>alert('Meja gagal diedit.'); window.location.href='../admin/pages/meja.php';</script>";
            }
            break;

    case 'delete':
        $meja = new meja;
        $meja->id_meja = $_GET['id_meja'];
        $meja->delete();


        if ($meja->delete()) {
            echo "User created successfully";
            header("location: ../admin/pages/meja.php");
        } else {
            echo "User creation failed";
            header("location: ../admin/pages/meja.php");
        }
        break;
}
