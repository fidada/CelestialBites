<?php
session_start();

$id_reservasi = $_SESSION['id_reservasi'];
$id_meja = $_SESSION['id_meja'];
$username = $_SESSION['username'];

function displayError($message)
{
    echo "<div class='alert alert-danger'>Error: $message</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celestial Bites</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .section-trans {
            padding: 6rem 0;
            margin-top: 0;
        }

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

    <section class="section-trans container align-item-left">
        <div class="d-flex flex-column">
            <h1>TRANSAKSI</h1>
            <form id="transaksiForm" action="../db/transaksi_action.php?action=insert" method="POST" class="contact-form">
                <div class="mb-3">
                    <label for="id_meja" class="form-control">Meja: <?php echo htmlspecialchars($id_meja); ?></label>
                    <input type="hidden" name="id_meja" value="<?php echo htmlspecialchars($id_meja); ?>">
                </div>

                <h3>Pilih Produk</h3>
                <div class="mb-3 search">
                    <input type="text" class="form-control" placeholder="Cari Produk" id="searchInput" onkeyup="filterProducts()">
                </div>

                <div class="mb-3">
                    <div style="max-height: 300px; overflow-y: auto;">
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
                                $result = $produk->read();

                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <tr>
                                        <td>
                                            <img style="max-height: 50px;" src="../img/card/<?php echo htmlspecialchars($row['gambar_produk']) ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['nama_produk']) ?>">
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
                </div>
                <div id="alertContainer"></div>
                <button type="button" class="btn btn-dark form-control submit-btn w-100" data-bs-toggle="modal" data-bs-target="#modal">Konfirmasi</button>
            </form>

            <div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row justify-content-center">
                                <div class="mb-3 text-center">
                                    <h2>Konfirmasi Pembayaran</h2>
                                    <p>Apakah Anda yakin ingin melanjutkan?</p>
                                </div>
                                <div class="d-flex flex-row justify-content-around w-100">
                                    <a class="btn col-sm-5 btn-outline-dark" data-bs-dismiss="modal">Batal</a>
                                    <button type="submit" class="btn col-sm-5 btn-dark" onclick="document.getElementById('transaksiForm').submit();">Konfirmasi</button>
                                </div>
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
                input.value = '0'; // Reset the input to 0
            } else {
                alertContainer.innerHTML = ''; // Clear any existing alert
            }
        }
    </script>
</body>

</html>