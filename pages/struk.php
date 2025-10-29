<?php
require_once '../db/meja.php';
$meja = new Meja();
require_once '../db/produk.php';
$produk = new produk();
session_start();

$id_reservasi = $_SESSION['id_reservasi'];
$total_transaksi = $_SESSION['total_transaksi'];

$id_meja = $_SESSION['id_meja'];
$harga_meja = $meja->getHargaMeja($id_meja);


$products = $_SESSION['products'];
$username = $_SESSION['username'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>celestial bites</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-trans {
            padding: 10rem 0;
        }

        .receipt-box {
            background-color: #f4e04d;
            border-radius: 15px;
            padding: 2rem;
            width: 60vw;
        }

        h1 {
            font-family: 'Perandory';
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
        }

        .btn-confirm {
            background-color: #000;
            color: #fff;
            font-weight: bold;
        }

        .receipt-item {
            font-weight: bold;
        }

        .receipt-value {
            text-align: right;
        }
    </style>
</head>

<body>
    <!-- navbar -->
    <?php include "../navbar.php"; ?>

    <section class="section-trans container d-flex flex-column justify-content-center align-items-center">
        <div class="receipt-box">
            <h1 class="mb-5">STRUK</h1>
            <div class="row my-3">
                <div class="col-6 receipt-item">Nama Pelanggan</div>
                <div class="col-6 receipt-value"><?php echo htmlspecialchars($username); ?></div>
            </div>
            <div class="row my-3">
                <div class="col-6 receipt-item">Meja</div>
                <div class="col-6 receipt-value"><?php echo htmlspecialchars($id_meja); ?> (Rp<?php echo htmlspecialchars(number_format($harga_meja, 0, ',', '.')); ?>)</div>
            </div>
            <div class="row my-3">
                <div class="col-6 receipt-item">Produk</div>
                <div class="col-6 receipt-value">
                    <?php foreach ($products as $product): ?>
                        <div><?php echo htmlspecialchars($product['nama_produk']); ?> x<?php echo htmlspecialchars($product['jumlah']); ?> (Rp<?php echo htmlspecialchars(number_format($product['subtotal'], 0, ',', '.')); ?>)</div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-6 receipt-item">Total Harga</div>
                <div class="col-6 receipt-value">Rp<?php echo htmlspecialchars(number_format($total_transaksi, 0, ',', '.')); ?></div>
            </div>
            <div class="d-grid mt-5">
                <a href="produk.php" class="btn btn-dark">Konfirmasi</a>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>

</body>

</html>
