<?php
include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
include "../../models/m_koneksi.php";

// Pastikan user sudah login
if (!isset($_SESSION['id_user'])) {
    header("Location: login.php");
    exit();
}

$id_user = $_SESSION['id_user'];
$mysql = new m_koneksi();
// Query mengambil data transaksi user + judul buku dari tabel buku
$query = mysqli_query($mysql->conn, "SELECT transaksi.*, buku.judul_buku 
                               FROM transaksi 
                               JOIN buku ON transaksi.id_buku = buku.id_buku 
                               WHERE transaksi.id_user = '$id_user' 
                               ORDER BY transaksi.id_transaksi DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Peminjaman | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { 
            background: #0e0c1a; 
            background: linear-gradient(135deg, #0e0c1a 0%, #1a1a2e 100%); 
            min-height: 100vh; 
            padding: 40px 20px; 
            color: white; 
        }
        .container { max-width: 800px; margin: 0 auto; }
        
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .btn-back { color: white; text-decoration: none; background: rgba(255,255,255,0.1); padding: 8px 20px; border-radius: 12px; font-size: 13px; transition: 0.3s; border: 1px solid rgba(255,255,255,0.1); }
        .btn-back:hover { background: rgba(255,255,255,0.2); transform: translateY(-2px); }

        .history-item {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 20px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 20px;
            transition: 0.3s;
        }

        .history-item:hover { background: rgba(255, 255, 255, 0.1); transform: translateX(10px); border-color: #a29bfe; }

        .icon-circle { width: 55px; height: 55px; border-radius: 15px; display: flex; justify-content: center; align-items: center; font-size: 1.2rem; }
        
        /* Status Color Classes */
        .status-wait { background: rgba(241, 196, 15, 0.2); color: #f1c40f; } /* Kuning - Menunggu */
        .status-active { background: rgba(85, 239, 196, 0.2); color: #55efc4; } /* Hijau - Dipinjam */
        .status-done { background: rgba(162, 155, 254, 0.2); color: #a29bfe; } /* Ungu - Selesai */
        .status-fail { background: rgba(255, 118, 117, 0.2); color: #ff7675; } /* Merah - Ditolak */

        .details { flex: 1; }
        .details h4 { font-size: 1.1rem; margin-bottom: 3px; font-weight: 600; }
        .details p { font-size: 0.85rem; color: #b2bec3; }

        .status-tag { font-size: 10px; background: rgba(255,255,255,0.1); padding: 4px 12px; border-radius: 8px; text-transform: uppercase; font-weight: 600; letter-spacing: 0.5px; border: 1px solid rgba(255,255,255,0.05); }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1><i class="fas fa-history" style="color: #a29bfe; margin-right: 10px;"></i> Riwayat</h1>
            <a href="lisbuku_user.php" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>

        <?php 
        if (mysqli_num_rows($query) > 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                
                // Logika Penentuan Icon dan Warna Status
                $status = $row['status_transaksi'];
                $icon = "fa-clock"; 
                $class = "status-wait";
                $pesan = "Pengajuan dikirim pada: " . date('d M Y', strtotime($row['tanggal_pinjam']));

                if ($status == 'Peminjaman Diterima') {
                    $icon = "fa-book-reader";
                    $class = "status-active";
                    $pesan = "Status: Sedang kamu pinjam. Jangan lupa kembalikan ya!";
                } elseif ($status == 'Transaksi Selesai') {
                    $icon = "fa-check-double";
                    $class = "status-done";
                    $pesan = "Buku telah sukses dikembalikan.";
                } elseif ($status == 'Peminjaman Ditolak') {
                    $icon = "fa-times-circle";
                    $class = "status-fail";
                    $pesan = "Maaf, admin menolak pengajuan ini.";
                }
        ?>
            <div class="history-item">
                <div class="icon-circle <?= $class ?>"><i class="fas <?= $icon ?>"></i></div>
                <div class="details">
                    <h4><?= $row['judul_buku'] ?></h4>
                    <p><?= $pesan ?></p>
                </div>
                <span class="status-tag"><?= $status ?></span>
            </div>
        <?php 
            } 
        } else {
            // Tampilan jika riwayat kosong
            echo "
            <div style='text-align: center; padding: 50px; opacity: 0.5;'>
                <i class='fas fa-box-open' style='font-size: 3rem; margin-bottom: 15px;'></i>
                <p>Belum ada aktivitas peminjaman.</p>
            </div>";
        }
        ?>
    </div>
</body>
</html>