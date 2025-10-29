<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .cb-logo .logo-1 {
            font-family: 'Perandory';
        }

        .cb-logo .logo-2 {
            font-family: "Burgues Script";
        }

        .title{
            font-size: 2em;
        }

        a {
            font-family: "Montserrat Medium";
            color: black;
            text-decoration: none;
        }

        .sidebar {
            height: 100vh;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #f8f9fa;
            padding-top: 20px;
            border-right: 1px solid black;
        }

        .sidebar a {
            padding: 15px;
            font-size: 18px;
            display: block;
            color: #000;
            text-decoration: none;
        }

        .sidebar a:hover:not(.logout-btn) {
            background-color: #ddd;
        }

        .sidebar .brand {
            font-family: 'Perandory', sans-serif;
            margin-bottom: 20px;
            text-align: center;
            font-size: 1.5rem;
        }

        .sidebar .brand span {
            display: block;
        }

        .sidebar .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
        }

        .main-content {
            margin-left: 260px;
            padding: 20px;
            position: absolute;
        }
    </style>
</head>

<body>
    <aside class="sidebar d-inline">
        <div class="brand">
            <span class="cb-logo d-flex justify-content-center">
                <p><p class="logo-1">celestial </p>
                <p class="logo-2">Bites</p></p>
                
            </span>
            <span class="title mt-5">Admin</span>
        </div>
        <a href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a href="produk.php"><i class="fas fa-box me-2"></i> Produk</a>
        <a href="meja.php"><i class="fas fa-chair me-2"></i> Meja</a>
        <a href="reservasi.php"><i class="fas fa-calendar-alt me-2"></i> Reservasi</a>
        <a href="transaksi.php"><i class="fas fa-receipt me-2"></i> Transaksi</a>
        <a href="user.php"><i class="fas fa-users me-2"></i> User</a>
        <a href="../../index.php" class="btn btn-outline-danger logout-btn" onclick="return confirm('Apakah anda yakin ingin logout?');"><i class="fas fa-sign-out-alt me-2"></i> Logout</a>
    </aside>

    <div class="main-content">
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>