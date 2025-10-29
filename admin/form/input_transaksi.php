<div class="mb-3 text-center">
    <h2>Tambah Transaksi</h2>
    <form action="../../db/admin_transaksi_action.php?action=insert" method="POST">
        <select class="form-select mb-3" name="id_reservasi" required>
            <option selected disabled>Pilih Reservasi</option>
            <?php
            require_once "../../db/reservasi.php";
            $reservasi = new Reservasi();
            foreach ($reservasi->read() as $option) { ?>
                <option value="<?= $option['id_reservasi'] ?>">
                    [<?= $option['id_reservasi'] ?>] Username: <?= $option['username'] ?> – Meja: <?= $option['id_meja'] ?>
                </option>
            <?php } ?>
        </select>

        <div class="row mb-3">
            <div class="col">
                <select class="form-select" name="id_produk" aria-label="Pilih Menu" required>
                    <option selected disabled>Pilih Produk</option>
                    <?php
                    require_once "../../db/produk.php";
                    $produk = new Produk();
                    foreach ($produk->read() as $option) { ?>
                        <option value="<?= $option['id_produk'] ?>">
                            [<?= $option['id_produk'] ?>] <?= $option['nama_produk'] ?> (Harga: <?= $option['harga_produk'] ?>)
                        </option>
                    <?php } ?>
                </select>
            </div>

            <div class="col">
                <input type="number" class="form-control" name="jumlah_pesanan" placeholder="Jumlah" min="1" required>
            </div>
        </div>

        <input type="text" class="form-control mb-3" name="subtotal" placeholder="Total Harga" readonly>

        <div class="d-flex flex-row justify-content-around">
            <a class="btn col-sm-5 btn-outline-dark" data-bs-dismiss="modal">Batal</a>
            <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi">
        </div>
    </form>
</div>
