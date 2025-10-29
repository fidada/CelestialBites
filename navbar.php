<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="style/font.css">
    <style>
        a {
            font-family: "Montserrat Medium";
        }

        .nav-item a {
            color: black;
        }

        .navbar {
            border: 1px solid black;
        }

        .celestial-bites .text-wrapper-12 {
            font-family: 'Perandory';
        }

        .celestial-bites .text-wrapper-4 {
            font-family: "Burgues Script";
        }

        .celestial-bites {
            font-size: 3vw;
            position: absolute;
            top: 0;
        }

        .modal-dialog {
            position: fixed;
            top: 60px;
            right: 15px;
            margin: 0;
            max-width: 300px;
        }

        .modal-backdrop {
            background-color: transparent !important;
        }

        .modal-body p {
            word-wrap: break-word;
            overflow-wrap: break-word;
            margin: 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top ms-3 me-3 mt-3">
        <div class="container">
            <a class="navbar-brand me-5" href="homes.php">
                <p class="celestial-bites">
                    <span class="text-wrapper-12">celestial </span>
                    <span class="text-wrapper-4">Bites</span>
                </p>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ps-5" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="reservasi.php">Reservasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tentang.php">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="kontak.php">Kontak</a>
                    </li>

                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="transaksi_menu.php">
                            <button class="btn btn-dark">
                            <i class="fa-solid fa-bell-concierge"></i> Pesan Menu
                            </button>
                            
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profil.php">
                            <button class="btn btn-outline-dark">
                                <i class="fa-solid fa-user"></i>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>