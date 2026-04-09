<?php 
    include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Anggota | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan style Glassmorphism yang konsisten dengan login.php */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
        }

        .card { 
            background: rgba(255, 255, 255, 0.9); 
            backdrop-filter: blur(10px);
            padding: 40px; 
            border-radius: 20px; 
            width: 100%; 
            max-width: 450px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        h2 { 
            color: #333; 
            margin-bottom: 10px; 
            text-align: center; 
            font-weight: 600; 
        }

        p {
            color: #777;
            font-size: 13px;
            text-align: center;
            margin-bottom: 25px;
        }

        input { 
            width: 100%; 
            padding: 12px 15px; 
            margin-bottom: 15px; 
            border: 2px solid #eee; 
            border-radius: 12px; 
            outline: none;
            transition: 0.3s;
        }

        input:focus {
            border-color: #764ba2;
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
        }

        button { 
            width: 100%; 
            padding: 14px; 
            background: linear-gradient(to right, #667eea, #764ba2); 
            color: white; 
            border: none; 
            border-radius: 12px; 
            font-weight: 600; 
            font-size: 15px;
            cursor: pointer; 
            transition: 0.3s;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
            margin-top: 10px;
        }

        button:hover { 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }

        .link { 
            text-align: center; 
            margin-top: 20px; 
            font-size: 13px; 
            color: #666;
        }

        a { 
            color: #764ba2; 
            text-decoration: none; 
            font-weight: 600; 
        }
        
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>tambah anggota</h2>
        
        <form method="post" action="../../../controllers/c_user.php?action=add">
            <input type="text" name="nama_lengkap" placeholder="Nama Lengkap" required>
            <input type="text" name="username" placeholder="NISN / Username" required>
            <input type="password" name="password" placeholder="Buat Password" required>
            
            <input type="hidden" name="status_anggota" value="false">
            <input type="hidden" name="role" value="siswa">
            
            <button type="submit" name="submit">DAFTAR SEBAGAI ANGGOTA</button>
        </form>
        
    </div>
</body>
</html>