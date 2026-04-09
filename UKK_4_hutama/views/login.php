<?php 
    include_once "../controllers/AuthController.php";
    use App\auth\guard;
    guard::isSigned();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        /* Menggunakan gaya visual Glassmorphism sesuai preferensi desain kamu */
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body { 
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); 
            height: 100vh; 
            display: flex; 
            justify-content: center; 
            align-items: center; 
            overflow: hidden;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 40px; 
            border-radius: 20px; 
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            width: 100%; 
            max-width: 400px; 
            text-align: center;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
        }

        h2 { color: #333; margin-bottom: 10px; font-weight: 600; letter-spacing: -0.5px; }
        p { color: #777; font-size: 14px; margin-bottom: 30px; }

        .input-group { margin-bottom: 20px; text-align: left; }
        
        input {
            width: 100%; 
            padding: 12px 15px; 
            border: 2px solid #eee;
            border-radius: 12px; 
            outline: none; 
            transition: 0.3s;
            background: #fdfdfd;
        }

        input:focus { 
            border-color: #764ba2; 
            box-shadow: 0 0 0 4px rgba(118, 75, 162, 0.1);
        }

        button {
            width: 100%; 
            padding: 14px; 
            border: none; 
            border-radius: 12px;
            background: linear-gradient(to right, #667eea, #764ba2); 
            color: white; 
            font-weight: 600;
            font-size: 16px;
            cursor: pointer; 
            transition: 0.3s; 
            margin-top: 10px;
            box-shadow: 0 4px 15px rgba(118, 75, 162, 0.3);
        }

        button:hover { 
            background: linear-gradient(to right, #5a368a, #4338ca); 
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(118, 75, 162, 0.4);
        }

        .footer-link { margin-top: 25px; font-size: 13px; color: #666; }
        .footer-link a { color: #764ba2; text-decoration: none; font-weight: 600; transition: 0.2s; }
        .footer-link a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>Selamat Datang</h2>
        <p>Silakan login ke akun E-Perpus Anda</p>
        
        <form action="../controllers/c_login.php" method="POST">
            <div class="input-group">
                <input type="text" name="username" placeholder="Username" required autocomplete="off">
            </div>
            <div class="input-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            
            <button type="submit" name="login">LOGIN</button>
        </form>

        <div class="footer-link">
            Belum jadi anggota? <a href="register.php">Daftar Sekarang</a>
        </div>
    </div>
</body>
</html>