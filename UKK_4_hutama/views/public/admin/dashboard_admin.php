<?php 

    include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();

    include_once "../../../controllers/c_penghitung.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --bg-color: #f8fafc;
            --sidebar-color: #1e293b;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --white: #ffffff;
            --shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            display: flex;
            min-height: 100vh;
        }

        /* --- SIDEBAR --- */
        .sidebar {
            width: 260px;
            background-color: var(--sidebar-color);
            padding: 2rem 1rem;
            position: fixed;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .sidebar-header h2 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 2.5rem;
            text-align: center;
            letter-spacing: 2px;
            font-weight: 700;
        }

        .nav-item {
            display: flex;
            align-items: center;
            color: #94a3b8;
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            margin-bottom: 0.5rem;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .nav-item i {
            margin-right: 12px;
            width: 20px;
            text-align: center;
        }

        .nav-item:hover, .nav-item.active {
            background-color: var(--primary-color);
            color: white;
        }

        .logout {
            margin-top: auto; /* Push logout to bottom */
            color: #f87171;
        }

        /* --- MAIN CONTENT --- */
        .main-content {
            margin-left: 260px;
            width: calc(100% - 260px);
            padding: 2rem 3rem;
        }

        /* Header Styling */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }

        .header h1 {
            color: var(--text-main);
            font-size: 1.75rem;
            font-weight: 700;
        }

        .admin-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            background: var(--white);
            padding: 8px 16px;
            border-radius: 50px;
            box-shadow: var(--shadow);
            font-weight: 600;
            color: var(--text-main);
        }

        .admin-profile i {
            font-size: 1.5rem;
            color: var(--primary-color);
        }

        /* --- STATS CARDS --- */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }

        .card {
            background: var(--white);
            padding: 1.5rem;
            border-radius: 16px;
            box-shadow: var(--shadow);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .card-info h3 {
            font-size: 2rem;
            color: var(--text-main);
            margin-bottom: 4px;
        }

        .card-info p {
            color: var(--text-muted);
            font-size: 0.9rem;
            font-weight: 500;
        }

        .card i {
            font-size: 2.5rem;
            color: var(--primary-color);
            opacity: 0.2;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar { width: 80px; padding: 2rem 0.5rem; }
            .nav-item span { display: none; }
            .main-content { margin-left: 80px; width: calc(100% - 80px); }
            .nav-item { justify-content: center; }
            .nav-item i { margin-right: 0; }
        }
    </style>
</head>
<body>

    <div class="sidebar">
            <div class="sidebar-header">
        <h2> ADMIN</h2>
    </div>
        <nav>
            <a href="#" class="nav-item active"><i class="fas fa-chart-pie"></i> <span>Dashboard</span></a>
            <a href="lisbuku.php" class="nav-item"><i class="fas fa-book"></i> <span>Kelola Buku</span></a>
            <a href="data_user.php" class="nav-item"><i class="fas fa-users"></i> <span>Kelola Anggota</span></a>
            <a href="admin_accbuku.php" class="nav-item"><i class="fas fa-exchange-alt"></i> <span>Peminjaman</span></a>
        </nav>
        <a href="../../../controllers/c_login.php?action=logout" class="nav-item logout"><i class="fas fa-power-off"></i> <span>Logout</span></a>
    </div>

    <div class="main-content">
        <div class="header">
            <div>
                <h1>Ringkasan Sistem</h1>
                <p style="color: var(--text-muted);">Selamat datang kembali, Master Admin.</p>
            </div>
            <div class="admin-profile">
                <i class="fas fa-user-circle"></i> 
                <span>Master Admin</span>
            </div>
        </div>

        <div class="stats-container">
            <div class="card">
                <div class="card-info">
                    <h3>
                        <?= number_format($total_buku->total_buku, 0, ',', '.'); ?>
                    </h3>
                    <p>Total Koleksi Buku</p>
                </div>
                <i class="fas fa-book"></i>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>
                        <?= number_format($total_anggota->total_anggota, 0, ',', '.'); ?>
                    </h3>
                    <p>Anggota Terdaftar</p>
                </div>
                <i class="fas fa-users"></i>
            </div>

            <div class="card">
                <div class="card-info">
                    <h3>
                        <?= number_format($total_peminjaman->total_peminjaman, 0, ',', '.'); ?>
                    </h3>
                    <p>Buku Sedang Dipinjam</p>
                </div>
                <i class="fas fa-clock"></i>
            </div>
        </div>
    </div>

</body>
</html>