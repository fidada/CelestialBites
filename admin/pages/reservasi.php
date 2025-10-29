<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin/style/font.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        section {
            padding: 8rem 6rem;
            height: 100vh;
            display: flex;
            justify-content: center;
        }

        h1 {
            font-family: "Perandory";
        }

        table {
            border: 3px solid black;
            border-radius: 20px;
            overflow-y: auto;
        }

        .container-fluid {
            height: 60vh;
        }

        .cont {
            height: 100%;
        }
    </style>
</head>

<body>
    <? include "../navbar.php"; ?>
    <section class="main-content section cont d-flex flex-column">
        <div class="mt-3 col-lg-12 d-flex flex-row">
            <div class="col-lg-6">
                <h1>Kelola Reservasi</h1>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <a href="#">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalInsert">tambah reservasi +</button>
                </a>
            </div>
        </div>
        <div class="container mt-3 px-0" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-hover">
                <thead style="position: sticky; top: 0;">
                    <tr class="table-dark">
                        <th>ID Reservasi</th>
                        <th>Username</th>
                        <th>Meja</th>
                        <th>Harga Meja</th>
                        <th>Waktu Reservasi</th>
                        <th>Tanggal Reservasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once "../../db/reservasi.php";
                    $reservasi = new Reservasi();
                    $result = $reservasi->readAdmin();

                    require_once "../../db/meja.php";
                    $meja = new Meja();
                    while ($row = $result->fetch_assoc()) {

                    ?>
                        <tr>
                            <td><?php echo $row['id_reservasi']; ?></td>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['id_meja']; ?></td>
                            <td><?php echo $row['harga_meja']; ?></td>
                            <td><?php echo $row['waktu_reservasi']; ?></td>
                            <td><?php echo $row['tanggal_reservasi']; ?></td>
                            <td>
                                <a href="../form/update_reservasi.php?id_reservasi=<?php echo $row['id_reservasi']; ?>">
                                    <button class="btn btn-warning">Update</button> </a>
                                </a>
                                <a href="../../db/reservasi_action.php?action=delete&id_reservasi=<?php echo $row['id_reservasi']; ?>">
                                    <button class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus reservasi ini?');">hapus</button>
                                </a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>


    <div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered py-5">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <? include "../form/input_reservasi.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>