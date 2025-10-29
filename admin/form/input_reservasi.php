<div class="mb-3 text-center">
    <h2>Tambah Reservasi</h2>
    <form action="../../db/reservasi_action.php?action=insert" method="POST">
        
        <label for="meja" class="form-label">Nama Customer</label>
        <select class="form-select mb-3" name="username" id="name_item" aria-label="Pilih Customer">
            <option disabled selected>Pilih Nama Customer ...</option>
            <?php
            require_once "../../db/user.php";
            $user = new user();
            ?>
            <?php foreach ($user->readCust() as $option) { ?>
                <option value="<?= $option['username'] ?>">
                    <?= $option['username'] ?>
                </option>
            <?php } ?>
        </select>

        <label for="meja" class="form-label">No Meja</label>
        <select class="form-select mb-3" name="id_meja" id="id_meja" aria-label="Pilih Meja" onchange="setHargaMeja()">
            <option disabled selected>Pilih ...</option>
            <?php
            require_once "../../db/meja.php";
            $meja = new Meja();
            ?>
            <?php foreach ($meja->read() as $option) { ?>
                <option value="<?= $option['id_meja'] ?>" data-harga="<?= $option['harga_meja'] ?>">
                    <?= $option['id_meja'] ?>–Rp<?= $option['harga_meja'] ?> [<?= $option['status'] ?>]
                </option>
            <?php } ?>
        </select>

        <!-- Hidden input for harga_meja -->
        <input type="hidden" id="harga_meja" name="harga_meja" value="">

        <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
        <input type="date" class="form-control mb-3" id="tanggal_reservasi" name="tanggal_reservasi" required>

        <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
        <input type="time" class="form-control mb-3" id="waktu_reservasi" name="waktu_reservasi" required>

        <div class="d-flex flex-row justify-content-around">
            <a class="btn col-sm-5 btn-outline-dark" data-bs-dismiss="modal">batal</a>
            <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi Reservasi">
        </div>
    </form>
</div>

<!-- JavaScript to set harga_meja -->
<script>
    function setHargaMeja() {
        const mejaSelect = document.getElementById('id_meja');
        const selectedOption = mejaSelect.options[mejaSelect.selectedIndex];
        const hargaMeja = selectedOption.getAttribute('data-harga');
        
        document.getElementById('harga_meja').value = hargaMeja;
    }
</script>
