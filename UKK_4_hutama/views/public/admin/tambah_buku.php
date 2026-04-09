<?php
include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
// Opsional: Pastikan yang akses cuma admin
// if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
//     echo "<script>alert('Akses ditolak!'); window.location='../login.php';</script>";
//     exit();
// }
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Tambah Buku Baru</h5>
                </div>
                <div class="card-body">
                    <form action="../../../controllers/c_buku.php?action=add" method="POST">
                        
                        <div class="mb-3">
                            <label class="form-label">Judul Buku</label>
                            <input type="text" name="judul" class="form-control" placeholder="Masukkan judul buku" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">pengarang</label>
                            <input type="text" name="pengarang" class="form-control" placeholder="Nama penulis/pengarang" required>
                        </div>

                        
                        <div class="mb-3">
                            <label class="form-label">Penerbit</label>
                            <input type="text" name="penerbit" class="form-control" placeholder="Nama penerbit" required>
                        </div>

                    
                        <div class="mb-4">
                            <label class="form-label">Stok Buku</label>
                            <input type="number" name="stok" class="form-control" placeholder="Jumlah stok" min="1" required>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="data_buku.php" class="btn btn-secondary">Batal</a>
                            <button type="submit" name="tambah" class="btn btn-primary">Simpan Buku</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>