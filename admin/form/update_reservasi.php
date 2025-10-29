<?php
require_once '../../db/reservasi.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$reservasi = new reservasi();
if (isset($_GET['id_reservasi'])) {
    $reservasi->id_reservasi = $_GET['id_reservasi'];
    $reservasiData = $reservasi->ReservasiId();
    if (!$reservasiData) {
        echo "reservasi not found!";
        exit;
    }
} else {
    echo "reservasi ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update reservasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <div class="mb-3 text-center">
                    <h2>Update Reservasi</h2>
                    <form action="../../db/reservasi_action.php?action=update" method="POST">
                        <input type="hidden" name="id_reservasi" value="<?php echo htmlspecialchars($reservasiData['id_reservasi']); ?>">

                        <label for="customer" class="form-label">Nama Customer</label>
                        <select class="form-select mb-3" name="username" id="name_item" aria-label="Pilih Customer">
                            <option selected><?php echo htmlspecialchars($reservasiData['username']); ?></option>
                            <?php
                            require_once "../../db/user.php";
                            $user = new user();
                            ?>
                            <?php foreach ($user->read() as $option) { ?>
                                <option value="<?= $option['username'] ?>">
                                    <?= $option['username'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <label for="meja" class="form-label">No Meja</label>
                        <select class="form-select mb-3" name="id_meja" id="name_item" aria-label="Pilih Meja" required>
                            <option selected value="<?php echo htmlspecialchars($reservasiData['id_meja']); ?>">
                                <?php echo htmlspecialchars($reservasiData['id_meja'] . ' – Rp' . $reservasiData['harga_meja']); ?>
                            </option>
                            <?php
                            require_once "../../db/meja.php";
                            $meja = new Meja();
                            foreach ($meja->read() as $option) { ?>
                                <option value="<?= $option['id_meja'] ?>">
                                    <?= $option['id_meja'] ?> – Rp<?= $option['harga_meja'] ?>
                                </option>
                            <?php } ?>
                        </select>

                        <input type="hidden" name="harga_meja" value="<?php echo htmlspecialchars($reservasiData['harga_meja']); ?>">

                        <label for="tanggal_reservasi" class="form-label">Tanggal Reservasi</label>
                        <input type="date" class="form-control mb-3" id="tanggal_reservasi" name="tanggal_reservasi" value="<?php echo htmlspecialchars($reservasiData['tanggal_reservasi']); ?>" required>

                        <label for="waktu_reservasi" class="form-label">Waktu Reservasi</label>
                        <input type="time" class="form-control mb-3" id="waktu_reservasi" name="waktu_reservasi" value="<?php echo htmlspecialchars($reservasiData['waktu_reservasi']); ?>" required>

                        <div class="d-flex flex-row justify-content-around">
                            <a class="btn col-sm-5 btn-outline-dark" href="javascript:window.history.back()">Batal</a>
                            <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi Reservasi">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateHargaMeja() {
            const mejaSelect = document.getElementById('id_meja');
            const selectedOption = mejaSelect.options[mejaSelect.selectedIndex];
            const hargaMeja = selectedOption.getAttribute('data-harga');

            document.getElementById('harga_meja').value = hargaMeja;
        }
    </script>
</body>

</html>