<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <link rel="stylesheet" href="admin/style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        section {
            padding: 8rem 2rem;
            height: 100vh;
            width: 70vw;
            justify-content: center;
            align-items: center;
        }

        section h1 {
            font-family: "Perandory";
            font-size: 3.5rem;
            margin-bottom: 2rem;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            align-items: center;
        }

        .button-container a {
            width: 100%;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <?php include "../navbar.php"; ?>
    <section class="section d-flex flex-column main-content">
        <h1 class="col-9 text-left mb-3">DASHBOARD ADMIN</h1>
        <div class="row">
            <div class="col-sm-6 button-container">
                <a href="produk.php" class="btn btn-dark btn-lg">
                    <h2 class="mb-0">Kelola Produk ></h2>
                </a>
                <a href="meja.php" class="btn btn-dark btn-lg">
                    <h2 class="mb-0">Kelola Meja ></h2>
                </a>
                <a href="reservasi.php" class="btn btn-dark btn-lg">
                    <h2 class="mb-0">Kelola Reservasi ></h2>
                </a>
                <a href="transaksi.php" class="btn btn-dark btn-lg">
                    <h2 class="mb-0">Kelola Transaksi ></h2>
                </a>
                <a href="user.php" class="btn btn-dark btn-lg">
                    <h2 class="mb-0">Kelola User ></h2>
                </a>
            </div>
            <div class="col-sm-6 d-flex justify-content-center">
                <img src="https://i.pinimg.com/564x/42/aa/62/42aa629c7f40c28a6a06858b3178c1fc.jpg" alt="Dashboard Image">
            </div>
        </div>
    </section>
</body>

</html>
