<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak Kami</title>
    <link rel="stylesheet" href="../style/font.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .title {
            font-family: "Perandory";
            font-size: 5rem;
        }

        p{
            font-family: "Montserrat Medium";

        }
        .content-section {
            padding: 4rem 0;
        }

        .contact-form {
            max-width: 100%;
            padding: 2rem;
        }

        .submit-btn {
            background-color: #000;
            color: #fff;
            font-size: 1.1rem;
        }

        .submit-btn:hover {
            background-color: #444;
        }

        .map-container {
            height: 200px;
            width: 100%;
            border: 1px solid #ddd;
        }

        .isi{
            padding-top: 6rem;
            padding-bottom: 6rem;
            height: 100vh;
        }
    </style>
</head>

<body>

    <?php include "../navbar.php";?>


    <section class="content-section isi container d-flex flex-column justify-content-center">
        <p class="title mb-4">Hubungi Kami</p>
        <div class="row">
            <div class="col-lg-6">
                <form class="contact-form">
                    <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama" required>
                    </div>
                    <div class="mb-3">
                        <input type="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" placeholder="Pesan" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-dark form-control submit-btn w-100">Submit</button>
                </form>
            </div>

            <div class="col-lg-6">
                <p>Kami senang mendengar dari Anda! Jika Anda memiliki pertanyaan, saran, atau ingin membuat reservasi, jangan ragu untuk menghubungi kami.</p>

                <div class="map-container mb-3">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d387190.27991469235!2d-74.25986508921497!3d40.69767006382509!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c259af18bcf65b%3A0xc80b8f06e177fe62!2sNew+York%2C+NY%2C+USA!5e0!3m2!1sen!2sid!4v1538549234743" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>

                <ul class="list-unstyled">
                    <li><i class="fa fa-map-marker"></i> Depok, Indonesia</li>
                    <li><i class="fa fa-phone"></i> 000111222333</li>
                    <li><i class="fa fa-envelope"></i> celestialbites@gmail.com</li>
                </ul>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
