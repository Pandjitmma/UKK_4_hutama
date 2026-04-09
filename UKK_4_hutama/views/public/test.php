<?php
include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
// require_once '../app/controllers/AuthController.php';

// // Sederhananya, kita tangkap perintah dari URL
// $url = isset($_GET['url']) ? $_GET['url'] : 'auth/login';

// $auth = new AuthController();

// // Routing sederhana
// if ($url == 'auth/login') {
//     $auth->login();
// } elseif ($url == 'auth/register') {
//     $auth->register();
// } elseif ($url == 'dashboard') {
//     require_once '../views/dashboard/index.php';
// }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { display: flex; height: 100vh; background: #f8f9fa; }
        
        /* Sidebar */
        .sidebar { width: 260px; background: #333; color: white; padding: 30px 20px; }
        .sidebar h2 { font-size: 20px; margin-bottom: 40px; color: #667eea; }
        .nav-item { padding: 15px; color: #ccc; cursor: pointer; border-radius: 8px; margin-bottom: 10px; transition: 0.3s; }
        .nav-item:hover, .active { background: #444; color: white; }

        /* Main Content */
        .main { flex: 1; padding: 30px; overflow-y: auto; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; }
        .user-profile { font-weight: 600; color: #333; }
        
        /* Grid Menu */
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; }
        .card { 
            background: white; padding: 30px; border-radius: 15px; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.05); text-align: center;
            transition: 0.3s; cursor: pointer; border-bottom: 4px solid transparent;
        }
        .card:hover { transform: translateY(-5px); border-color: #667eea; }
        .card h3 { margin-bottom: 10px; color: #444; }
        .card p { font-size: 13px; color: #888; }
        
        .logout-btn { color: #ff4d4d; text-decoration: none; font-size: 14px; }
        a{
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>E-Perpus App</h2>
        <div class="nav-item active">Beranda</div>
        <div class="logout-btn nav-item"><a  href="../../controllers/c_login.php?action=logout">keluar sistem</a></div>
        
    </div>

    <div class="main">
        <header>
            <div class="user-profile">Halo, Siswa Pengguna 👋</div>
        </header>

        <h1>Pilih Layanan</h1>
        <div class="menu-grid">
            <a class="card" href="lisbuku_user.php">
                <h3>📚 Katalog Buku</h3>
                <p>Jelajahi koleksi buku yang tersedia</p>
            <a class="card" href="profil.php">
                <h3>👥 Anggota</h3>
                <p>Lihat profil dan status keanggotaan</p>
            </a>
               <a class="card" href="riwayat.php">
                <h3> 👆🏼 riwayat</h3>
                <p>Lihat riwayat transaksi</p>
            </a>
        </div>
    </div>
</body>
</html>
<?php
// Sederhananya saja dulu tanpa class core
// $url = isset($_GET['url']) ? $_GET['url'] : 'auth/login';

// if ($url == 'auth/login') {
//     include '../views/auth/login.php';
// } elseif ($url == 'auth/register') {
//     include '../views/auth/register.php';
// } elseif ($url == 'dashboard') {
//     include '../views/dashboard/index.php';
// }
?>