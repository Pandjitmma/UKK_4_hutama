<?php
include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();

// Pastikan path mundur ke file class anggota sudah benar
require_once "../../../models/m_koneksi.php";
require_once "../../../models/m_user.php";

$obj_anggota = new anggota();

// Cek apakah ada ID di URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID tidak ditemukan!'); window.location='data_user.php';</script>";
    exit();
}

$id_user = $_GET['id'];
// Ambil data user yang mau diedit
$user = $obj_anggota->get_user_by_id($id_user);

if (!$user) {
    die("Data user tidak ditemukan di database.");
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0">Edit Data Pengguna</h5>
                </div>
                <div class="card-body">
                    <form action="../../../controllers/c_user.php?action=update" method="POST">
                        
                        <input type="hidden" name="id_user" value="<?= $user->id_user; ?>">

                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" class="form-control" value="<?= htmlspecialchars($user->nama_lengkap); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($user->username); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select" required>
                                <option value="siswa" <?= ($user->role == 'siswa') ? 'selected' : ''; ?>>Siswa</option>
                                <option value="admin" <?= ($user->role == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Status ACC Anggota</label>
                            <select name="status_anggota" class="form-select" required>
                                <option value="true" <?= ($user->status_anggota == 'true') ? 'selected' : ''; ?>>Aktif (True)</option>
                                <option value="false" <?= ($user->status_anggota == 'false') ? 'selected' : ''; ?>>Belum di-ACC (False)</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="data_user.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>