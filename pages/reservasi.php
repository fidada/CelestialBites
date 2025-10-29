<?php
require_once "../db/db.php";
$db = new Database();

$query = "SELECT id_meja, harga_meja, status FROM meja";
$result = $db->query($query);

$mejaList = [];
if ($result) {
    $mejaList = $result->fetch_all(MYSQLI_ASSOC);
}

session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>reservasi - Celestial Bites</title>
    <link rel="stylesheet" href="../style/font.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .section-reservasi {
            padding: 60px 0;
        }

        .table-selection {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }

        .table-selection .card {
            width: 100%;
            max-width: 300px;
            border-radius: 10px;
        }

        .table-selection .card-body {
            text-align: center;
        }

        .btn-lanjut {
            display: block;
            width: 200px;
            background-color: black;
            color: white;
            margin: 20px auto;
            padding: 15px;
            border-radius: 50px;
        }

        .table-map {
            width: 100%;
            max-width: 600px;
            margin: 20px auto;
            display: block;
        }

        h2 {
            font-family: "Brush Script MT", cursive;
        }

        h1 {
            font-family: 'Perandory';
        }
    </style>
</head>

<body>
    <?php include "../navbar.php"; ?>

    <section class="section-reservasi container mt-4">
        <div class="row">
            <div class="text-left">
                <h1 style="margin-bottom: 0;">reservasi</h1>
                <p>Silahkan memilih meja sebelum melakukan pemesanan</p>
            </div>

            <div class="col-sm-6">
                <img src="../img/map.png" alt="Table Map" class="table-map img-fluid">
            </div>
            <div class="container col-sm-6 d-flex flex-row align-items-center ">
                <div class="card py-3 mb-0" style="border:1px solid black">
                    <form action="../db/reservasi_action.php?action=insert_customer" method="post">
                        <div class="container d-flex">
                            <div class="col-sm-6">
                                <div class="card" style="border:none;">
                                    <div class="card-body">
                                        <?php
                                        foreach ($mejaList as $meja) {
                                            if ($meja['status'] === 'tersedia') {
                                                echo '<tr class="table table-striped table-hover">';
                                                echo '<td>';
                                                echo '<label>';
                                                echo '<input type="radio" name="id_meja" value="' . $meja['id_meja'] . '" data-harga="' . $meja['harga_meja'] . '"> ';
                                                echo $meja['id_meja'] . ' - Rp ' . number_format($meja['harga_meja'], 0, ',', '.');
                                                echo '</label>';
                                                echo '</td>';
                                                echo '</tr>';
                                            } else {
                                                echo '<tr class="table table-striped table-hover">';
                                                echo '<td>';
                                                echo '<label style="padding-inline: 3px; background-color:grey; font-weight:bold; color:white;">';
                                                echo $meja['id_meja'] . ' (Tidak Tersedia)';
                                                echo '</label>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                        }

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="harga_meja" id="harga_meja" value="0">
                            <div class="col-sm-6 px-2 align-item-center">
                                <div class="card" style="border:1px solid black">
                                    <div class="card-body">
                                    <input type="hidden" name="username" class="form-control mb-2" value="<?= htmlspecialchars($username) ?>">
                                    <p class="mb-0">Tanggal Reservasi</p>
                                    <input type="date" name="tanggal_reservasi" class="form-control mb-2" required>
                                    <p class="mb-0">Waktu Reservasi</p>
                                    <input type="time" name="waktu_reservasi" class="form-control mb-2" required>
                                    <button type="submit" class="form-control btn btn-outline-dark btn-lg">Selanjutnya ></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $.ajax({
            url: '../db/get_user_id.php',
            type: 'POST',
            data: {
                username: username
            },
            success: function(response) {
                var data = JSON.parse(response);
                console.log(data);

                if (data.user_id) {
                    $('#user_id').val(data.user_id); 
                    console.log('User ID set to: ' + data.user_id); 
                } else {
                    alert('User not found');
                }
            },
            error: function() {
                alert('Error fetching user_id');
            }
        });
    </script>


    <script>
        document.querySelectorAll('input[name="id_meja"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                document.getElementById('harga_meja').value = this.getAttribute('data-harga');
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>