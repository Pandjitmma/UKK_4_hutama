<?php
include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
require_once "../../models/m_koneksi.php";
require_once "../../models/m_buku.php";
$kon = new m_koneksi();

if (isset($_POST['tambah'])) {
    $id_buku = $_POST['id_buku'];
    
   // Pastikan session id_user ada (diatur saat login)
    if (!isset($_SESSION['id_user'])) {
        echo "<script>alert('Sesi habis, silakan login kembali'); window.location='../login.php';</script>";
        exit();
    }

    $id_user = $_SESSION['id_user']; 
    $tanggal_pinjam = date('Y-m-d');
    $status = "tunggu";

    // Pastikan nama variabel koneksi ($mysql) sesuai dengan di m_koneksi.php
    $query = "INSERT INTO transaksi (id_user, id_buku, tanggal_pinjam, status_transaksi) 
              VALUES ('$id_user', '$id_buku', '$tanggal_pinjam', '$status')";

    if (mysqli_query($kon->conn, $query)) {
        echo "<script>
            alert('Berhasil diajukan! Silakan tunggu verifikasi admin.');
            window.location='riwayat.php';
        </script>";
    } else {
        echo "Error Database: " . mysqli_error($kon->conn);
    }
} else {
    header("Location: lisbuku_user.php");
}
?>