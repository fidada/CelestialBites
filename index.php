
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('img/home_cover.jpg');
            background-size: cover;
            font-family: 'Montserrat SemiBold';
        }

        .back {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            background-color: white;
            padding: 2rem;
            width: 100%;
            max-width: 500px;
        }

        h1 {
            font-family: 'Perandory';
            color: black;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
        }

        a {
            color: black;
        }
    </style>
</head>

<body>
    <div class="back">
        <div class="container d-flex flex-column">
            <h1>LOGIN</h1>
            <form class="login-form" action="db/login_proses.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" placeholder="Masukkan username anda" name="username" required>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" placeholder="Masukkan kata sandi anda" name="password" required>
                </div>
                <button type="submit" class="btn btn-outline-dark form-control submit-btn w-100">Login</button>
                <div class="d-flex flex-row mt-5">
                    <p>Belum punya akun? </p>
                    <a class="ms-auto" href="register.php"><b>register</b></a>
                </div>
            </form>
        </div>
    </div>
</body>

</html>