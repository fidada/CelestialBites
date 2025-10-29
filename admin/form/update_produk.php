<?php
require_once '../../db/produk.php';

$produk = new Produk();

if (isset($_GET['id_produk'])) {
    $produk->id_produk = $_GET['id_produk'];
    $produkData = $produk->ProdukId();
    if (!$produkData) {
        echo "Produk tidak ditemukan!";
        exit;
    }
} else {
    echo "Produk ID tidak disediakan!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <h2 class="text-center">Update Produk</h2>
                <form action="../../db/produk_action.php?action=update" method="POST" enctype="multipart/form-data">
                    <input type="hidden" class="form-control mb-3" name="id_produk" value="<?php echo htmlspecialchars($produkData['id_produk']); ?>">
                    <input type="text" class="form-control mb-3" placeholder="Nama Produk" name="nama_produk" value="<?php echo htmlspecialchars($produkData['nama_produk']); ?>" required>

                    <div class="form-check form-check-inline">
                        <input type="radio" name="kategori" id="kategori_makanan" value="makanan" <?php echo ($produkData['kategori'] == 'makanan') ? 'checked' : ''; ?>>
                        <label for="kategori_makanan" class="form-check-label">Makanan</label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input type="radio" name="kategori" id="kategori_minuman" value="minuman" <?php echo ($produkData['kategori'] == 'minuman') ? 'checked' : ''; ?>>
                        <label for="kategori_minuman" class="form-check-label">Minuman</label>
                    </div>

                    <input type="number" class="form-control mb-3" placeholder="Harga" name="harga_produk" value="<?php echo htmlspecialchars($produkData['harga_produk']); ?>" required>
                    <div class="mb-3">
                        <label for="gambar_produk" class="form-label">Gambar Saat Ini</label><br>
                        <?php if (!empty($produkData['gambar_produk'])) { ?>
                            <img src="../../img/card/<?php echo htmlspecialchars($produkData['gambar_produk']); ?>" alt="Gambar Produk" style="max-height: 150px;"><br>
                        <?php } else { ?>
                            <p>Belum ada gambar yang diunggah.</p>
                        <?php } ?>
                    </div>

                    <div class="mb-3">
                        <label for="gambar_produk" class="form-label">Pilih Gambar Baru (opsional)</label><br>
                        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk">
                        <input type="hidden" name="gambar_produk_lama" value="<?php echo htmlspecialchars($produkData['gambar_produk']); ?>">
                    </div>

                    <div class="d-flex flex-row justify-content-around">
                        <a class="btn col-sm-5 btn-outline-dark" href="javascript:window.history.back()">Batal</a>
                        <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi">
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>