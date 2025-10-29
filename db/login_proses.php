<?php
session_start();
include 'db.php';

$db = new Database();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username = ?";
    $stmt = $db->prepare($query);
    
    if ($stmt) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama'] = $user['nama'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['alamat'] = $user['alamat'];
                $_SESSION['role'] = $user['role'];

                if ($user['role'] == 'admin') {
                    header("Location: ../admin/pages/dashboard.php");
                } else if ($user['role'] == 'customer') {
                    header("Location: ../pages/homes.php");
                }
                exit();
            } else {
                echo "<script>alert('Password Salah.'); history.back();</script>";
            }
        } else {
            echo "<script>alert('Username tidak ditemukan.'); history.back();</script>";
        }
    } else {
        echo "Query error: " . $db->conn->error;
    }
}
?>