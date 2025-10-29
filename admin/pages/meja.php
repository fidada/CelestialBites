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
            height: 100vh;
            width: 100vh;
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
            height: 500px;
        }

    </style>
</head>

<body>
    <? include "../navbar.php"; ?>
    <section class="section cont d-flex flex-column main-content" style="width: 75%;">
        <div class="col-lg-12 d-flex flex-row">
            <div class="col-lg-6">
                <h1>Kelola Meja</h1>
            </div>
        </div>
        <div class="container mt-3 px-0" style="max-height: 500px; overflow-y: auto;">
            <table class="table table-hover">
                <thead style="position: sticky; top: 0;">
                    <tr class="table-dark">
                        <th>Letak (id meja)</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../db/meja.php';
                    $meja = new Meja();
                    $result = $meja->read();

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['id_meja']; ?></td>
                            <td><?php echo $row['harga_meja']; ?></td>
                            <td>
                                <?php 
                                    if( $row['status'] == "tersedia"){
                                        echo "<p style='color:green'><b>tersedia</b></p>";
                                    }else{
                                        echo "<p style='color:red'><b>tidak tersedia</b></p>";
                                    }; 
                                ?>
                            </td>
                            <td>
                                <a href="../form/update_meja.php?id_meja=<?php echo $row['id_meja'];?>">
                                    <button class="btn btn-warning">Update</button> </a>
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>