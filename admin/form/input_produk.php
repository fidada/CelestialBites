<div class="mb-3 text-center">
    <h2>Tambah Produk</h2>
    <form action="../../db/produk_action.php?action=insert" method="post" enctype="multipart/form-data">
    <input type="text" class="form-control mb-3" placeholder="nama produk" name="nama_produk" required>
    <div class="form-check form-check-inline">
        <input type="radio" id="makanan" name="kategori" value="makanan" required> <label for="makanan">makanan</label>
    </div>
    <div class="form-check form-check-inline mb-3">
        <input type="radio" id="minuman" name="kategori" value="minuman" required> <label for="minuman">minuman</label>
    </div>
    <input type="number" class="form-control mb-3" placeholder="harga" name="harga_produk" required>
    <div class="mb-3">
        <label for="gambar_produk" class="form-label">Gambar Produk</label>
        <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" required>
    </div>
    <input type="submit" class="btn btn-dark" value="Konfirmasi">
</form>

</div>
