<?php
require_once '../../db/user.php';

$user = new user();

if (isset($_GET['user_id'])) {
    $user->user_id = $_GET['user_id'];
    $userData = $user->userId();
    if (!$userData) {
        echo "user tidak ditemukan!";
        exit;
    }
} else {
    echo "user ID tidak disediakan!";
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
                <h2 class="text-center">Update user</h2>
                <form action="../../db/user_action.php?action=update" method="POST">

                    <input type="hidden" class="form-control mb-3" placeholder="user_id" name="user_id" value="<?php echo htmlspecialchars($userData['user_id']); ?>">

                    <input type="text" class="form-control mb-3" placeholder="username" name="username" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                    <input type="text" class="form-control mb-3" placeholder="nama" name="nama" value="<?php echo htmlspecialchars($userData['nama']); ?>" required>
                    <input type="text" class="form-control mb-3" placeholder="email" name="email" value="<?php echo htmlspecialchars($userData['email']); ?>" required>
                    <input type="password" class="form-control mb-3" placeholder="password (kosongkan jika tidak ingin mengubah)" name="password">
                    <textarea type="text" class="form-control mb-3" placeholder="alamat" name="alamat" required><?php echo htmlspecialchars($userData['alamat']); ?></textarea>
                    <input type="number" class="form-control mb-3" placeholder="no telp" name="no_telp" value="<?php echo htmlspecialchars($userData['no_telp']); ?>" required>

                    <div class="form-check form-check-inline">
                        <input type="radio" name="role" id="customer" value="customer" <?php echo ($userData['role'] == 'customer') ? 'checked' : ''; ?>>
                        <label for="customer" class="form-check-label">Customer</label>
                    </div>
                    <div class="form-check form-check-inline mb-3">
                        <input type="radio" name="role" id="admin" value="admin" <?php echo ($userData['role'] == 'admin') ? 'checked' : ''; ?>>
                        <label for="admin" class="form-check-label">Admin</label>
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