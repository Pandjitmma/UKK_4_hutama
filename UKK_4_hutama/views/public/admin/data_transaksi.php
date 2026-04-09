<?php
include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
// Pastikan path mundur ke folder models sudah benar
require_once "../../../models/m_koneksi.php";

$kon = new m_koneksi();

// Query untuk mengambil data transaksi digabung dengan tabel user dan buku
// Sesuaikan nama tabel dan kolom (id_user, id_buku) dengan database Anda
$query = "SELECT transaksi.*, users.nama_lengkap, buku.judul_buku 
          FROM transaksi 
          JOIN users ON transaksi.id_user = users.id_user 
          JOIN buku ON transaksi.id_buku = buku.id_buku
          ORDER BY transaksi.tanggal_pinjam DESC";

$result = mysqli_query($kon->conn, $query);

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transaksi Peminjaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h3 class="mb-4">Kelola Peminjaman Buku</h3>
    
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama Peminjam</th>
                            <th>Judul Buku</th>
                            <th>Tanggal Pinjam</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $no = 1;
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama_lengkap']); ?></td>
                            <td><?= htmlspecialchars($row['judul_buku']); ?></td>
                            <td><?= htmlspecialchars($row['tanggal_pinjam']); ?></td>
                            <td>
                                <?php if ($row['status_transaksi'] == 'Menunggu Verifikasi') { ?>
                                    <span class="badge bg-warning text-dark"><?= $row['status_transaksi']; ?></span>
                                <?php } elseif ($row['status_transaksi'] == 'Dipinjam') { ?>
                                    <span class="badge bg-success"><?= $row['status_transaksi']; ?></span>
                                <?php } else { ?>
                                    <span class="badge bg-danger"><?= $row['status_transaksi']; ?></span>
                                <?php } ?>
                            </td>
                            <td>
                                <?php if ($row['status_transaksi'] == 'Menunggu Verifikasi') { ?>
                                    
                                    <a href="../../../controllers/c_acc_admin.php?aksi=acc&id=<?= $row['id_transaksi']; ?>" 
                                       class="btn btn-success btn-sm mb-1"
                                       onclick="return confirm('Yakin ingin menyetujui peminjaman ini?')">ACC</a>
                                    
                                    <a href="../../../controllers/c_acc_admin.php?aksi=tolak&id=<?= $row['id_transaksi']; ?>" 
                                       class="btn btn-danger btn-sm mb-1"
                                       onclick="return confirm('Yakin ingin menolak peminjaman ini?')">Tolak</a>
                                       
                                <?php } else { ?>
                                    <span class="text-muted fst-italic">Selesai</span>
                                <?php } ?>
                            </td>
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