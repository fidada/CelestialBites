<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk - Celestial Bites</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="../style/card.css">

    <style>
        .section-produk {
            padding: 60px 0;
        }

        .promo-container {
            background-color: #f2eb90;
            padding: 20px;
            border-radius: 15px;
            border: 1px solid black;
        }

        .promo-container img {
            width: 100%;
            max-width: 500px;
            border: 1px solid black;
            border-radius: 15px;
        }

        .best-menu {
            max-height: 400px;
            /* Define the max-height for vertical scroll */
            overflow-y: auto;
            /* Enable vertical scrolling */
            padding: 30px 0;
            background-color: #f2eb90;
            box-shadow: -5px 8px 0px black;
            border-radius: 0px 0px 15px 15px;
        }


        .best-menu .card {
            margin-bottom: 20px;
            margin-inline: 20px;
        }

        .header-promo,
        h2 {
            text-align: left;
            font-family: "Perandory";
        }

        h3 {
        font-family: 'Montserrat' ;
        font-weight: bold;
        }

        .header-promo {
        font-size: 5rem;
        }

        .nav-tabs-custom .nav-link {
        color: black;
        /* Inactive tab text color */
        border: none;
        background-color: transparent;
        /* Custom background color */
        border-radius: 10px 10px 0px 0px;
        border: none;
        }

        .nav-tabs-custom .nav-link.active {
        background-color: #f2eb90 !important;
        /* Active tab background color */
        color: black;
        /* Active tab text color */
        border: none;
        }

        .nav-link:hover {
        color: black !important;
        }
        </style>
</head>

<body>

    <? include "../navbar.php"; ?>


    <section class="section-produk container mt-5">

        <div class="promo-container mb-5 d-flex">
            <div class="col-sm-6 text-left">
                <div class="header-promo">Promo Unik Menunggu</div>
                <p>Pantau promo-promo dengan berbagai potongan harga!</p>
            </div>
            <div class="col-sm-6">
                <img src="../img/diskon.png" alt="Promo Image" class="img-fluid">
            </div>
        </div>


        <h2 class="text-left mb-2">Yang Terbaru</h2>
        <div class="container my-4">
            <div class="d-flex gap-3">
                <?php
                require_once '../db/produk.php';
                require_once '../db/db.php';

                $db = new Database();
                $query = "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 3";
                $result = $db->query($query);

                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '
                                        <div class="col-md-4 mb-3 d-flex align-items-stretch">
                                            <div class="card" style="width: 100%;">
                                                <img style="max-height: 250px;" src="../img/card/' . htmlspecialchars($row['gambar_produk']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nama_produk']) . '">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . htmlspecialchars($row['nama_produk']) . '</h5>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Rp' . number_format($row['harga_produk'], 0, ',', '.') . '</li>
                                                </ul>
                                            </div>
                                        </div>';
                    }
                } else {
                    echo '<p>Produk Tidak Ditemukan.</p>';
                }
                ?>
            </div>
        </div>



        <h2 class="text-left mt-5">Menu Terbaik</h2>
        <div class="container mt-2">
            <div class="p-1">

                <div class="row">
                    <nav>
                        <div class="nav nav-tabs nav-tabs-custom" id="nav-tab" role="tablist">
                            <button class="col-sm-6 nav-link active" id="nav-mak-tab" data-bs-toggle="tab" data-bs-target="#nav-mak" type="button" role="tab" aria-controls="nav-mak" aria-selected="true">
                                <h3>Makanan</h3>
                            </button>
                            <button class="col-sm-6 nav-link" id="nav-min-tab" data-bs-toggle="tab" data-bs-target="#nav-min" type="button" role="tab" aria-controls="nav-min" aria-selected="false">
                                <h3>Minuman</h3>
                            </button>
                        </div>
                    </nav>
                </div>


                <div class="best-menu">
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-mak" role="tabpanel" aria-labelledby="nav-mak-tab">
                            <div class="row" style="margin-right: 2rem;">
                                <?php
                                require_once '../db/produk.php';
                                require_once '../db/db.php';

                                $db = new Database();
                                $query = "SELECT * FROM produk WHERE kategori = 'makanan'";
                                $result = $db->query($query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '
                                        <div class="col-md-4 mb-3 d-flex align-items-stretch">
                                            <div class="card" style="width: 100%;">
                                                <img style="max-height: 250px;" src="../img/card/' . htmlspecialchars($row['gambar_produk']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nama_produk']) . '">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . htmlspecialchars($row['nama_produk']) . '</h5>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Rp' . number_format($row['harga_produk'], 0, ',', '.') . '</li>
                                                </ul>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<p>Produk Tidak Ditemukan.</p>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="nav-min" role="tabpanel" aria-labelledby="nav-min-tab">
                            <div class="row" style="margin-right: 2rem;">
                                <?php
                                require_once '../db/produk.php';
                                require_once '../db/db.php';

                                $db = new Database();
                                $query = "SELECT * FROM produk WHERE kategori = 'minuman'";
                                $result = $db->query($query);

                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '
                                        <div class="col-md-4 mb-3 d-flex align-items-stretch">
                                            <div class="card" style="width: 100%;">
                                                <img style="max-height: 250px;" src="../img/card/' . htmlspecialchars($row['gambar_produk']) . '" class="card-img-top" alt="' . htmlspecialchars($row['nama_produk']) . '">
                                                <div class="card-body">
                                                    <h5 class="card-title">' . htmlspecialchars($row['nama_produk']) . '</h5>
                                                </div>
                                                <ul class="list-group list-group-flush">
                                                    <li class="list-group-item">Rp' . number_format($row['harga_produk'], 0, ',', '.') . '</li>
                                                </ul>
                                            </div>
                                        </div>';
                                    }
                                } else {
                                    echo '<p>Produk Tidak Ditemukan.</p>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>


    <script src="https:
</body>

</html>