<?php
session_start();
require_once '../db/db.php';
require_once '../db/transaksi.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$db = new Database();
$transaksi = new Transaksi();

$user_query = "SELECT * FROM user WHERE user_id = ?";
$user_stmt = $db->conn->prepare($user_query);
$user_stmt->bind_param("i", $user_id);
$user_stmt->execute();
$user_result = $user_stmt->get_result();

if ($user_result->num_rows === 1) {
    $user_data = $user_result->fetch_assoc();
    $username = $user_data['username'];
    $nama = $user_data['nama'];
    $email = $user_data['email'];
    $alamat = $user_data['alamat'];
}

// Fetch user's transactions
$query = "SELECT 
        transaksi.id_transaksi, 
        reservasi.id_meja,
        reservasi.tanggal_reservasi, 
        produk.nama_produk, 
        transaksi.jumlah_pesanan, 
        transaksi.subtotal
        FROM transaksi
        JOIN reservasi ON transaksi.id_reservasi = reservasi.id_reservasi
        JOIN produk ON transaksi.id_produk = produk.id_produk
        WHERE reservasi.user_id = ?
        ORDER BY transaksi.id_transaksi DESC";

$stmt = $db->conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        h1 {
            text-align: left;
            font-family: "Perandory";
            margin-bottom: 0;
        }
    </style>
</head>

<body>
    <?php include '../navbar.php'; ?>

    <div class="container" style="margin-top: 7rem;">

        <h1>Profil Pengguna</h1>

        <div class="row mt-3">
            <div class="col-sm-4">
                <div class="card" style="border: 1px solid black; height: 60vh;">
                    <div class="card-body d-flex flex-column">
                        <p>
                            Username: <?php echo htmlspecialchars($username); ?>
                        </p>
                        <p>
                            Nama: <?php echo htmlspecialchars($nama); ?>
                        </p>
                        <p>
                            Email: <?php echo htmlspecialchars($email); ?>
                        </p>
                        <p>
                            Alamat: <?php echo htmlspecialchars($alamat); ?>
                        </p>
                        <a href="../index.php" class="mt-auto">
                            <button class="btn mb-3 btn-outline-danger">
                                <i class="fa-solid fa-right-from-bracket"></i> logout
                            </button>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <h2>Riwayat Transaksi</h2>
                <div class="container px-0" style="max-height: 380px; overflow-y: auto;">
                    <table class="table table-striped">
                        <thead class="table-dark" style="position: sticky; top: 0;">
                            <tr>
                                <th>Tanggal Reservasi</th>
                                <th>ID Meja</th>
                                <th>Produk</th>
                                <th>Jumlah Pesanan</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['tanggal_reservasi']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['id_meja']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['nama_produk']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['jumlah_pesanan']) . "</td>";
                                    echo "<td>Rp" . number_format($row['subtotal'], 0, ',', '.') . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "
                                    <tr>
                                        <td colspan='5'>Anda belum pernah melakukan transaksi. <br><br>
                                        <a href='reservasi.php'>
                                            <button class='btn btn-dark'>Reservasi sekarang</button> 
                                        </a>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>