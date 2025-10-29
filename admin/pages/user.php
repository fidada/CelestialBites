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
            display: flex;
            margin-top: 3rem;
        }

        h1 {
            font-family: "Perandory";
        }

        table {
            border: 3px solid black;
            border-radius: 20px;
            overflow-y: auto;
        }
    </style>
</head>

<body>
    <? include "../navbar.php"; ?>
    <section class="section cont d-flex flex-column main-content" style="width: 80%">
        <div class=" col-lg-12 d-flex flex-row">
            <div class="col-lg-6">
                <h1>Kelola User</h1>
            </div>
            <div class="col-lg-6 d-flex justify-content-end">
                <a href="#">
                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#modalInsert">Tambah User +</button>
                </a>
            </div>
        </div>
        <div class="container mt-0 px-0" style="max-height: 600px; overflow-y: auto;">
            <table class="table table-hover ">
                <thead class="table-dark" style="position: sticky; top: 0;">
                    <tr class="table-dark">
                        <th>Username</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>No Telp</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    require_once '../../db/user.php';
                    require_once '../../db/db.php';
                    $user = new user();
                    $db = new Database();
                    $query = "SELECT * FROM user ORDER BY user_id desc";
                    $result = $db->query($query);

                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['no_telp']; ?></td>
                            <td><?php echo $row['role']; ?></td>
                            <td>
                                <a href="../form/update_user.php?user_id=<?php echo $row['user_id']; ?>">
                                    <button class="btn btn-warning">Update</button>
                                </a>
                                <a href="../../db/user_action.php?action=delete&user_id=<?php echo $row['user_id']; ?>">
                                    <button class="btn btn-outline-danger" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?');">hapus</button>
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
                        <? include "../form/input_user.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>