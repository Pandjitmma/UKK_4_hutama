<?php 
    include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profil Saya | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #0e0c1a 0%, #0e0c1a 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; padding: 20px; }
        
        .profile-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 30px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            color: white;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .avatar {
            width: 120px; height: 120px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin: 0 auto 20px;
            display: flex; justify-content: center; align-items: center;
            font-size: 3rem; border: 4px solid rgba(255,255,255,0.3);
        }

        h2 { margin-bottom: 5px; letter-spacing: 1px; }
        .role-badge { background: #55efc4; color: #2d3436; padding: 4px 15px; border-radius: 20px; font-size: 12px; font-weight: bold; }

        .info-list { margin: 30px 0; text-align: left; }
        .info-item { background: rgba(0,0,0,0.1); padding: 15px; border-radius: 15px; margin-bottom: 10px; display: flex; align-items: center; gap: 15px; }
        .info-item i { color: #f1c40f; width: 20px; }
        .info-label { font-size: 11px; color: #dcdde1; display: block; }

        .btn-edit { background: white; color: #0e0c1a; border: none; padding: 12px 30px; border-radius: 15px; font-weight: 600; cursor: pointer; transition: 0.3s; width: 100%; }
        .btn-edit:hover { background: #dcdde1; transform: scale(1.02); }
        .back-link { display: block; margin-top: 20px; color: white; text-decoration: none; font-size: 13px; opacity: 0.7; }
    </style>
</head>
<body>
    <div class="profile-card">
        <div class="avatar"><i class="fas fa-user"></i></div>
        <h2><?= $_SESSION['username'] ?></h2>
        <span class="role-badge">ANGGOTA AKTIF</span>

        <div class="info-list">
            <div class="info-item">
                <i class="fas fa-id-card"></i>
                <div><span class="info-label">NISN / Username</span><strong><?= $_SESSION['id_user'] ?></strong></div>
            </div>
            <div class="info-item">
                <i class="fas fa-calendar-alt"></i>
                <div><span class="info-label">Bergabung Sejak</span><strong><?= date('d F Y', strtotime($_SESSION['gabung'])) ?></strong></div>
            </div>
        </div>
        <a href="?url=dashboard" class="back-link">Kembali ke Dashboard</a>
    </div>
</body>
</html>