<div class="mb-3 text-center">
    <h2>Tambah Customer</h2>
    <form action="../../db/user_action.php?action=insert_user" method="post">
        <input type="text" class="form-control mb-3" placeholder="username" name="username" required>
        <input type="text" class="form-control mb-3" placeholder="nama" name="nama" required>
        <input type="text" class="form-control mb-3" placeholder="email" name="email" required>
        <input type="password" class="form-control mb-3" placeholder="password" name="password" required>
        <textarea type="text" class="form-control mb-3" placeholder="alamat" name="alamat" required></textarea>
        <input type="number" class="form-control mb-3" placeholder="no telp" name="no_telp" required>

        <div class=" form-check-inline">
            <input type="radio" id="customer" name="role" value="customer" required> <label for="customer">Customer</label>
        </div>
        <div class=" form-check-inline mb-5">
            <input type="radio" id="admin" name="role" value="admin" required> <label for="admin">Admin</label>
        </div>

        <div class="d-flex flex-row justify-content-around">
            <a class="btn col-sm-5 btn-outline-dark" data-bs-dismiss="modal">batal</a>
            <input type="submit" class="btn col-sm-5 btn-dark" value="Konfirmasi">
        </div>
    </form>
</div>