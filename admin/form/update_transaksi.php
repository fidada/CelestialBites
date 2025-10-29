<?php
require_once '../../db/transaksi.php';
require_once '../../db/reservasi.php';
require_once '../../db/produk.php';

$transaksi = new Transaksi();
$reservasi = new Reservasi();
$produk = new Produk();

if (isset($_GET['id_transaksi'])) {
    $transaksi->id_transaksi = $_GET['id_transaksi'];
    $transaksiData = $transaksi->transaksiId();

    if (!$transaksiData) {
        die("Error: Transaction not found.");
    }
} else {
    die("Error: Transaction ID not provided.");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <div class="mb-3 text-center">
                    <h2>Update Transaksi</h2>

                    <form action="../../db/admin_transaksi_action.php?action=update" method="POST">
                        <input type="hidden" name="id_transaksi" value="<?= htmlspecialchars($transaksiData['id_transaksi']); ?>">

                        <div class="mb-3">
                            <label for="id_reservasi" class="form-label">Reservasi</label>
                            <select class="form-select" name="id_reservasi" id="id_reservasi" required>
                                <option value="<?= htmlspecialchars($transaksiData['id_reservasi']); ?>" selected>
                                    <?= htmlspecialchars('['.$transaksiData['id_reservasi'] .'] '. $transaksiData['username'] . ' – Meja: ' . $transaksiData['id_meja']); ?>
                                </option>
                                <?php foreach ($reservasi->read() as $option): ?>
                                    <option value="<?= $option['id_reservasi'] ?>">
                                        [<?= $option['id_reservasi'] ?>] <?= $option['username'] ?> – Meja: <?= $option['id_meja'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="id_produk" class="form-label">Produk</label>
                            <select class="form-select" name="id_produk" id="id_produk" required>
                                <option value="<?= htmlspecialchars($transaksiData['id_produk']); ?>" selected>
                                    [<?= htmlspecialchars($transaksiData['id_produk']); ?>] <?= htmlspecialchars($transaksiData['nama_produk']); ?>
                                </option>
                                <?php foreach ($produk->read() as $option): ?>
                                    <option value="<?= $option['id_produk'] ?>">
                                        [<?= $option['id_produk'] ?>] <?= $option['nama_produk'] ?> (Harga: <?= $option['harga_produk'] ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_pesanan" class="form-label">Jumlah Pesanan</label>
                            <input type="number" class="form-control" id="jumlah_pesanan" name="jumlah_pesanan" value="<?= htmlspecialchars($transaksiData['jumlah_pesanan']); ?>" required min="1">
                        </div>

                        <a class="btn col-sm-4 btn-outline-dark" href="javascript:window.history.back()">Batal</a>
                        <input type="submit" class="btn col-sm-7 btn-dark" value="Konfirmasi">
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
