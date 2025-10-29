<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        p {
            font-family: "Montserrat Medium";
        }

        h2 {
            font-family: "Montserrat SemiBold";
        }

        .isi {
            padding-top: 6rem;
            padding-bottom: 6rem;
            height: 100vh;
        }

        .rb-brand .text-wrapper-12 {
            font-family: 'Perandory';
        }

        .rb-brand .text-wrapper-4 {
            font-family: "Burgues Script";
        }

        .rb-brand {
            font-size: 3vw;
            margin-top: auto;
        }

        .container .img {
            max-width: 70%;
        }

        .image {
            align-items: flex-end;
        }
    </style>
</head>

<body>
    <?php include "../navbar.php"; ?>

    <div class="container isi d-flex">
        <div class="col-sm-6 d-flex flex-column justify-content-between">
            <h2>Tentang Kami</h2>
            <p>
                Selamat datang di Celestial Bites, restoran klasik yang terletak 
                di jantung hotel bintang ternama kami. Dengan suasana yang elegan 
                dan menu yang menggoda, kami menyajikan pengalaman bersantap yang 
                tak terlupakan. Setiap hidangan dipersiapkan dengan bahan-bahan berkualitas tinggi dan resep tradisional, menghadirkan cita rasa yang otentik. Kami berkomitmen untuk memberikan pelayanan terbaik dan atmosfer yang nyaman, menjadikan setiap kunjungan sebagai momen istimewa. Bergabunglah dengan kami untuk menikmati perjalanan kuliner yang luar biasa!
            </p>
            <p class="rb-brand">
                <span class="text-wrapper-12">celestial </span>
                <span class="text-wrapper-4">Bites</span>
            </p>
        </div>
        <div class="col-sm-6 image d-flex flex-column align-item-end">
            <img src="../img/flower.png" alt="us" class="img img-fluid">
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>