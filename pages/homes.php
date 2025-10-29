<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Celestial Bites</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        ::-webkit-scrollbar {
            width: 0;
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

        .hero {
            height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .hero h1 {
            font-size: 15rem;
            font-family: "Perandory", cursive;
            font-weight: bold;
            color: white;
            text-shadow: 0px 0px 10px rgba(0, 0, 0, 0.8);
        }

        .hero h2 {
            font-size: 10rem;
            font-family: "Burgues Script", cursive;
            margin-top: -5rem;
            -webkit-text-stroke: 1px #000000;
            color: white;
        }

        .btn-reservasi {
            margin-top: 20px;
            background-color: black;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
        }

        .section-tentang-kami {
            /* background-color: #f8e8a0; */
            padding: 60px 0;
            margin: 1rem;
            background: rgba(226, 226, 226, 0.3);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .section-tentang-kami h2 {
            font-family: "Perandory", cursive;
            font-size: 2.5rem;
        }

        .ulasan-terbaik {
            background-color: white;
        }

        .ulasan-terbaik .card {
            border-radius: 10px;
            border: 1px solid black;
        }

        .ulasan-terbaik h2 {
            font-family: "Perandory", cursive;
            font-size: 3rem;
        }

        .section-tentang-kami img {
            width: 30vw;
            height: 60vh;
        }

        .card img {
            height: 30vh;
            border-radius: 10px;

        }

        .image {
            height: 100vh;
            left: 0;
            object-fit: cover;
            position: fixed;
            top: 0;
            width: 100vw;
            z-index: -2;
        }
    </style>
</head>

<body>
    <?php include "../navbar.php"; ?>

    <img class="image" alt="Image" src="../img/home_cover.jpg" />

    <section class="hero">
        <div>
            <h1>Celestial</h1>
            <h2>Bites</h2>
            <a href="reservasi.php" class="btn btn-dark px-5">Mulai Reservasi</a>
        </div>
    </section>

    <section class="section-tentang-kami">
        <div class="container">
            <div class="row d-flex flex-row justify-content-between">
                <div class="d-inline col-md-6">
                    <h2>Tentang Kami</h2>
                    <p>Lorem ipsum dolor sit amet consectetur. Amet elementum ac non arcu. At habitant egestas est massa scelerisque ante vitae volutpat.</p>
                    <div class="col-row-auto"></div>
                    <h3>Jam Operasional</h3>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Senin–Sabtu: 07.00–21.00</li>
                        <li class="list-group-item">Minggu/Hari Libur: 12.00–21.00</li>
                    </ul>
                </div>
                <div class="col-auto">
                    <img src="../img/flower.png" class="img-fluid rounded" alt="Tentang Kami">
                </div>
            </div>
        </div>
    </section>

    <footer class="ulasan-terbaik py-5">
        <div class="container">
            <h2 class="text-center mb-5">Ulasan Terbaik</h2>
            <div class="row">
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card">
                        <img src="../img/vivi.jpg" class="card-img-top px-3 mt-3" alt="Jocat">
                        <div class="card-body text-center">
                            <p>"Hidangan Beef Stroganoff sangat lezat dan pelayanan ramah. Pasti akan kembali!"</p>
                            <footer class="blockquote-footer">黃珈熙</footer>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card">
                        <img src="../img/user2.png" class="card-img-top px-3 mt-3" alt="Yves">
                        <div class="card-body text-center">
                            <p>"Salad Yunani segar dan panna cotta sempurna. Staf profesional dan suasana nyaman!"</p>
                            <footer class="blockquote-footer">Yves</footer>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 d-flex align-items-stretch">
                    <div class="card">
                        <img src="../img/user1.png" class="card-img-top px-3 mt-3" alt="Seulgi">
                        <div class="card-body text-center">
                            <p>"Pizza enak dengan topping berkualitas. Koktail kreatif dan atmosfer hangat!"</p>
                            <footer class="blockquote-footer">Seulgi</footer>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>