<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('img/home_cover.jpg');
            background-size: cover;
            font-family: 'Montserrat SemiBold', sans-serif;
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
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            font-family: 'Perandory', sans-serif;
            color: black;
            font-weight: bold;
            text-align: center;
            text-decoration: underline;
            margin-bottom: 1.5rem;
        }

        a {
            color: black;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="back">
        <div class="container">
            <h1>REGISTER</h1>
            <form class="login-form" action="db/user_action.php?action=register" method="post">
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <input type="text" class="form-control" placeholder="Username" name="username" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 mb-3">
                        <input type="number" class="form-control" placeholder="No Telp" name="no_telp" required>
                    </div>
                    <div class="col-sm-6 mb-3">
                        <textarea class="form-control" placeholder="Alamat" rows="2" name="alamat" required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-outline-dark form-control w-100">Register</button>
                <div class="d-flex flex-row mt-4">
                    <p class="mb-0">Already have an account?</p>
                    <a class="ms-auto" href="index.php"><b>Login</b></a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
