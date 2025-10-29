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
            padding: 8rem 2rem;
            height: 100vh;
            width: 80vw;
            justify-content: center;
            align-items: center;
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
                <h1>Kelola Produk</h1>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <a href="#">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalInsert">tambah produk +</button>
                </a>
            </div>
        </div>
        <div class="container mt-3 px-0" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-hover">
                <thead style="position: sticky; top: 0;">
                    <tr class="table-dark">
                        <th>Gambar Produk</th>
                        <th>ID Produk</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Produk</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../db/produk.php';
                    $produk = new Produk();
                    $result = $produk->read();

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <img style="max-height: 250px;" src="../../img/card/<?php echo htmlspecialchars($row['gambar_produk']) ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['nama_produk']) ?>">
                            </td>
                            <td><?php echo $row['id_produk']; ?></td>
                            <td><?php echo $row['nama_produk']; ?></td>
                            <td><?php echo $row['kategori']; ?></td>
                            <td>Rp<?php echo number_format($row['harga_produk'], 0, ',', '.'); ?></td>
                            <td>
                                <a href="../form/update_produk.php?id_produk=<?php echo $row['id_produk']; ?>">
                                    <button class="btn btn-warning">Update</button> </a>
                                </a>
                                <a href="../../db/produk_action.php?action=delete&id_produk=<?php echo $row['id_produk']; ?>">
                                    <button class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus produk ini?');">hapus</button>
                                </a>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </section>


    <div class="modal fade" id="modalInsert" tabindex="-1" aria-labelledby="modalInsertLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered py-5">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <? include "../form/input_produk.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>