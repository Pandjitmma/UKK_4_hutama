<?php
include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
// Pastikan path ke m_koneksi.php sudah benar sesuai dengan struktur folder kamu
include "../../../models/m_koneksi.php";

if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php");
    exit();
}

$mysql = new m_koneksi();

// PROSES ACC, TOLAK, ATAU KEMBALIKAN
if (isset($_GET['aksi']) && isset($_GET['id'])) {
    $id_transaksi = $_GET['id'];
    $aksi = $_GET['aksi'];
    
    // Default query update
    $query_update = "";
    
    // Status disesuaikan dengan enum database kamu
    if ($aksi == 'terima') {
        $status_baru = 'di pinjam'; 
        $query_update = "UPDATE transaksi SET status_transaksi = '$status_baru' WHERE id_transaksi = '$id_transaksi'";
    } elseif ($aksi == 'tolak') {
        $status_baru = 'di tolak';
        $query_update = "UPDATE transaksi SET status_transaksi = '$status_baru' WHERE id_transaksi = '$id_transaksi'";
    } elseif ($aksi == 'kembali') {
        // FITUR BARU: Proses Pengembalian Buku
        $status_baru = 'dikembalikan';
        $tgl_kembali = date('Y-m-d'); // Mengambil tanggal hari ini
        
        // Update status dan juga isi kolom tanggal_kembali
        $query_update = "UPDATE transaksi SET status_transaksi = '$status_baru', tanggal_kembali = '$tgl_kembali' WHERE id_transaksi = '$id_transaksi'";
    }
    
    // Eksekusi query jika ada isinya
    if (!empty($query_update)) {
        if (mysqli_query($mysql->conn, $query_update)) {
            // $_SERVER['PHP_SELF'] akan otomatis me-refresh halaman admin_accbuku.php ini
            echo "<script>alert('Aksi berhasil dilakukan!'); window.location='".$_SERVER['PHP_SELF']."';</script>";
        } else {
            $error_db = mysqli_error($mysql->conn);
            echo "<script>alert('Gagal! Error: $error_db');</script>";
        }
    }
}

// QUERY AMAN: Mengambil data transaksi dan mengurutkannya
$sql_query = "SELECT transaksi.*, buku.judul_buku, users.nama_lengkap 
              FROM transaksi 
              JOIN buku ON transaksi.id_buku = buku.id_buku 
              JOIN users ON transaksi.id_user = users.id_user 
              ORDER BY 
                  FIELD(transaksi.status_transaksi, 'tunggu') DESC, 
                  FIELD(transaksi.status_transaksi, 'di pinjam') DESC, 
                  transaksi.id_transaksi DESC";

$query = mysqli_query($mysql->conn, $sql_query);

// PENCEGAH CRASH: Jika query gagal
if (!$query) {
    die("<div style='background:#1a1a2e; color:red; padding:40px; text-align:center; font-family:sans-serif;'>
            <h2>🚨 ERROR DATABASE 🚨</h2>
            <p>" . mysqli_error($mysql->conn) . "</p>
            <p>Pastikan nama tabel 'buku' dan 'user' benar-benar ada di database kamu tanpa typo.</p>
         </div>");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pengajuan | Admin E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: #0e0c1a; background: linear-gradient(135deg, #0e0c1a 0%, #1a1a2e 100%); min-height: 100vh; padding: 40px 20px; color: white; }
        .container { max-width: 900px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-back { color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 8px 20px; border-radius: 12px; font-size: 13px; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1); }
        .btn-back:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }

        .history-item { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); padding: 20px; border-radius: 20px; margin-bottom: 15px; display: flex; align-items: center; gap: 20px; transition: 0.3s; }
        .history-item:hover { background: rgba(255, 255, 255, 0.1); transform: translateX(5px); border-color: #a29bfe; }
        .icon-circle { width: 55px; height: 55px; border-radius: 15px; display: flex; justify-content: center; align-items: center; font-size: 1.2rem; flex-shrink: 0; }
        
        .status-wait { background: rgba(241, 196, 15, 0.2); color: #f1c40f; } 
        .status-active { background: rgba(85, 239, 196, 0.2); color: #55efc4; } 
        .status-done { background: rgba(162, 155, 254, 0.2); color: #a29bfe; } 
        .status-fail { background: rgba(255, 118, 117, 0.2); color: #ff7675; } 

        .details { flex: 1; }
        .details h4 { font-size: 1.1rem; margin-bottom: 3px; font-weight: 600; }
        .details p { font-size: 0.85rem; color: #b2bec3; }
        .details .user-info { color: #a29bfe; font-weight: 500; font-size: 0.9rem; margin-bottom: 4px; display: block;}
        .action-area { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }
        .status-tag { font-size: 10px; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 8px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; border: 1px solid rgba(255,255,255,0.05); text-align: center;}
        
        .btn-action-group { display: flex; gap: 8px; }
        .btn-act { padding: 6px 12px; border-radius: 8px; font-size: 0.8rem; font-weight: 600; color: white; text-decoration: none; transition: 0.2s; border: none; cursor: pointer; display: flex; align-items: center; gap: 5px;}
        .btn-acc { background: rgba(85, 239, 196, 0.2); color: #55efc4; border: 1px solid rgba(85, 239, 196, 0.3); }
        .btn-acc:hover { background: #55efc4; color: #1a1a2e; }
        .btn-tolak { background: rgba(255, 118, 117, 0.2); color: #ff7675; border: 1px solid rgba(255, 118, 117, 0.3); }
        .btn-tolak:hover { background: #ff7675; color: white; }
        
        /* Style untuk tombol kembalikan */
        .btn-kembali { background: rgba(162, 155, 254, 0.2); color: #a29bfe; border: 1px solid rgba(162, 155, 254, 0.3); }
        .btn-kembali:hover { background: #a29bfe; color: white; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-tasks" style="color: #a29bfe; margin-right: 10px;"></i> Kelola Pengajuan</h1>
            <a href="dashboard_admin.php" class="btn-back"><i class="fas fa-home"></i> Dashboard</a>
        </div>

        <?php 
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                
                $status = $row['status_transaksi'];
                $icon = "fa-clock"; 
                $class = "status-wait";
                $pesan = "Tanggal Pengajuan: " . date('d M Y', strtotime($row['tanggal_pinjam']));

                if ($status == 'di pinjam') {
                    $icon = "fa-book-reader";
                    $class = "status-active";
                    $pesan = "Sedang di pinjam sejak: " . date('d M Y', strtotime($row['tanggal_pinjam']));
                } elseif ($status == 'dikembalikan') {
                    $icon = "fa-check-double";
                    $class = "status-done";
                    // Tampilkan tanggal kembali jika datanya ada
                    $tgl_kmb = $row['tanggal_kembali'] ? date('d M Y', strtotime($row['tanggal_kembali'])) : '-';
                    $pesan = "Buku telah dikembalikan pada: " . $tgl_kmb;
                } elseif ($status == 'di tolak') {
                    $icon = "fa-times-circle";
                    $class = "status-fail";
                    $pesan = "Pengajuan ditolak oleh admin.";
                }
        ?>
            <div class="history-item">
                <div class="icon-circle <?= $class ?>"><i class="fas <?= $icon ?>"></i></div>
                <div class="details">
                    <span class="user-info"><i class="fas fa-user-circle"></i> Peminjam: <?= htmlspecialchars($row['nama_lengkap']) ?></span>
                    <h4><?= htmlspecialchars($row['judul_buku']) ?></h4>
                    <p><?= $pesan ?></p>
                </div>
                
                <div class="action-area">
                    <span class="status-tag"><?= $status ?></span>
                    
                    <div class="btn-action-group">
                        <?php if ($status == 'tunggu') { ?>
                            <a href="?aksi=terima&id=<?= $row['id_transaksi'] ?>" class="btn-act btn-acc" onclick="return confirm('ACC peminjaman ini?')">
                                <i class="fas fa-check"></i> ACC
                            </a>
                            <a href="?aksi=tolak&id=<?= $row['id_transaksi'] ?>" class="btn-act btn-tolak" onclick="return confirm('Tolak peminjaman ini?')">
                                <i class="fas fa-times"></i> Tolak
                            </a>
                        <?php } ?>

                        <?php if ($status == 'di pinjam') { ?>
                            <a href="?aksi=kembali&id=<?= $row['id_transaksi'] ?>" class="btn-act btn-kembali" onclick="return confirm('Konfirmasi bahwa buku ini telah dikembalikan oleh siswa?')">
                                <i class="fas fa-undo"></i> Kembalikan
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php 
            } 
        } else {
            echo "
            <div style='text-align: center; padding: 50px; opacity: 0.5;'>
                <i class='fas fa-inbox' style='font-size: 3rem; margin-bottom: 15px;'></i>
                <p>Belum ada data pengajuan peminjaman.</p>
            </div>";
        }
        ?>
    </div>
</body>
</html>