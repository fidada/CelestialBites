<?php
require_once '../../db/meja.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);

$meja = new Meja();
if (isset($_GET['id_meja'])) {
    $meja->id_meja = $_GET['id_meja'];
    $mejaData = $meja->getMejaById(); 
    if (!$mejaData) {
        echo "Meja not found!";
        exit;
    }
} else {
    echo "meja ID not provided!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Meja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card" style="width: 100%; max-width: 500px;">
            <div class="card-body">
                <div class="mb-3 text-center">
                    <h2>Update Meja</h2>
                    <form action="../../db/meja_action.php?action=update" method="POST">
                        <input type="hidden" name="id_meja" value="<?php echo htmlspecialchars($mejaData['id_meja']); ?>">
                        <input type="text" class="form-control mb-3" placeholder="Letak Meja (huruf, angka)" name="id_meja" value="<?php echo htmlspecialchars($mejaData['id_meja']); ?>" readonly>
                        <input type="number" class="form-control mb-3" placeholder="Harga" name="harga_meja" value="<?php echo htmlspecialchars($mejaData['harga_meja']); ?>" required>

                        <div class="form-check form-check-inline">
                            <input type="radio" name="status" id="status_tersedia" value="tersedia" <?php echo ($mejaData['status'] == 'tersedia') ? 'checked' : ''; ?>>
                            <label for="status_tersedia" class="form-check-label">Tersedia</label>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input type="radio" name="status" id="status_tidak_tersedia" value="tidak tersedia" <?php echo ($mejaData['status'] == 'tidak tersedia') ? 'checked' : ''; ?>>
                            <label for="status_tidak_tersedia" class="form-check-label">Tidak Tersedia</label>
                        </div>

                        <div class="d-flex flex-row justify-content-around">
                            <a class="btn col-sm-5 btn-outline-dark" href="javascript:window.history.back()">Batal</a>
                            <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</body>

</html>