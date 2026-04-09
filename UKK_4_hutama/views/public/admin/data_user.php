<?php
session_start();include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
// Pastikan path mundur ke file class anggota sudah benar
require_once "../../../models/m_koneksi.php";
require_once "../../../models/m_user.php";

// Instansiasi class anggota
$obj_anggota = new anggota();

// Panggil fungsi yang ada di class untuk ngejalanin SELECT * FROM users
$data_user = $obj_anggota->ambil_data();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna (Siswa & Admin)</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Kelola Data Anggota</h3>
        <a href="tambah_user.php" class="btn btn-primary">+ Tambah User</a>
    </div>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>No</th>
                            <th>Nama Lengkap</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Status ACC</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Cek apakah data user ada isinya (tidak false)
                        if ($data_user) {
                            $no = 1;
                            // Looping data pakai foreach karena bentuknya array dari fungsi ambil_data()
                            foreach ($data_user as $row) { 
                        ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            
                            <td><?= htmlspecialchars($row->nama_lengkap); ?></td>
                            <td><?= htmlspecialchars($row->username); ?></td>
                            
                            <td class="text-center">
                                <span class="badge <?= ($row->role == 'admin') ? 'bg-primary' : 'bg-secondary'; ?>">
                                    <?= strtoupper($row->role); ?>
                                </span>
                            </td>
                            
                            <td class="text-center">
                                <?php if ($row->status_anggota == 'true') { ?>
                                    <span class="badge bg-success">Aktif</span>
                                <?php } else { ?>
                                    <span class="badge bg-warning text-dark">Belum di-ACC</span>
                                <?php } ?>
                            </td>
                            
                            <td class="text-center">
                                <a href="edit_user.php?id=<?= $row->id_user; ?>" class="btn btn-sm btn-warning mb-1">Edit</a>
                                <a href="../../../controllers/c_user.php?action=hapus&id=<?= $row->id_user; ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin hapus user ini?')">Hapus</a>
                            </td>
                        </tr>
                        <?php 
                            } 
                        } else { 
                        ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">Belum ada data user yang terdaftar.</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>