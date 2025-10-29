<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

require_once '../db/db.php';
require_once '../db/transaksi.php';

$db = new Database();

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

$query = "SELECT reservasi.id_reservasi, reservasi.user_id, meja.id_meja, reservasi.tanggal_reservasi, reservasi.waktu_reservasi, meja.harga_meja, user.username 
            FROM reservasi
            JOIN user ON reservasi.user_id = user.user_id
            JOIN meja ON reservasi.id_meja = meja.id_meja
            WHERE reservasi.user_id = ?";

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
    <title>Celestial Bites</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        h1,
        h2 {
            font-family: 'Perandory';
        }

        table {
            max-height: 3rem;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <?php include "../navbar.php"; ?>

    <section class="container py-0" style="margin-top: 6rem;">
        <div class="d-flex flex-column">
            <h1>TRANSAKSI</h1>
            <form id="transaksiForm" action="../db/transaksi_action.php?action=insert" method="POST">
                <div class="mb-3">
                    <p>Pilih Meja Anda:</p>
                    <select class="form-select mb-3" name="id_reservasi" required>
                        <?php if ($result->num_rows > 0) { // Cek apakah ada data 
                        ?>
                            <option selected disabled>Pilih Reservasi</option>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <option value="<?= htmlspecialchars($row['id_meja']) ?>">
                                    <?= htmlspecialchars($row['username']) ?> – Meja: <?= htmlspecialchars($row['id_meja']) ?>
                                </option>
                            <?php } ?>
                        <?php } else { // Jika tidak ada data, tampilkan opsi khusus 
                        ?>
                            <option selected disabled>Silahkan lakukan reservasi terlebih dahulu</option>
                        <?php } ?>
                    </select>

                </div>

                <h3>Pilih Produk</h3>
                <div class="mb-3 search">
                    <input type="text" class="form-control" placeholder="Cari Produk" id="searchInput" onkeyup="filterProducts()">
                </div>

                <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                    <table class="table" id="productTable">
                        <thead class="table-dark" style="position: sticky; top: 0;">
                            <tr>
                                <th>Produk</th>
                                <th>Nama Produk</th>
                                <th>Kategori</th>
                                <th>Harga</th>
                                <th>Kuantitas</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once '../db/produk.php';
                            $produk = new Produk;
                            $produk_result = $produk->read();

                            while ($row = $produk_result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td>
                                        <img style="max-height: 50px;" src="../img/card/<?php echo htmlspecialchars($row['gambar_produk']) ?>" alt="<?php echo htmlspecialchars($row['nama_produk']) ?>">
                                    </td>
                                    <td class="product-name"><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                    <td><?php echo htmlspecialchars($row['kategori']); ?></td>
                                    <td><?php echo 'Rp' . number_format($row['harga_produk'], 0, ',', '.'); ?></td>
                                    <td>
                                        <input type="number" name="jumlah_pesanan[<?php echo $row['id_produk']; ?>]" class="form-control quantity-input" placeholder="0" min="0" onchange="checkQuantity(this)">
                                    </td>
                                    <input type="hidden" name="harga_produk[<?php echo $row['id_produk']; ?>]" value="<?php echo htmlspecialchars($row['harga_produk']); ?>">
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div id="alertContainer"></div>
                <button type="button" class="btn btn-dark w-100" data-bs-toggle="modal" data-bs-target="#modal">Konfirmasi</button>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body text-center">
                            <h2>Konfirmasi Pembayaran</h2>
                            <p>Apakah Anda yakin ingin melanjutkan?</p>
                            <div class="d-flex justify-content-around">
                                <button class="btn btn-outline-dark" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-dark" onclick="document.getElementById('transaksiForm').submit();">Konfirmasi</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterProducts() {
            const input = document.getElementById('searchInput').value.toLowerCase();
            const table = document.getElementById('productTable');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 1; j < cells.length; j++) {
                    if (cells[j].textContent.toLowerCase().includes(input)) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? '' : 'none';
            }
        }

        function checkQuantity(input) {
            const quantityInputs = document.querySelectorAll('.quantity-input');
            let filledInputs = 0;

            quantityInputs.forEach(input => {
                if (parseInt(input.value) > 0) {
                    filledInputs++;
                }
            });

            const alertContainer = document.getElementById('alertContainer');

            if (filledInputs > 1) {
                alertContainer.innerHTML = '<div class="alert alert-danger">Silahkan pilih salah satu produk dari menu.</div>';
                input.value = '0';
            } else {
                alertContainer.innerHTML = '';
            }
        }
    </script>
</body>

</html>