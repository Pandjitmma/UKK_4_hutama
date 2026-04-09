<?php 
    include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku Saya | E-Perpus</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --glass: rgba(255, 255, 255, 0.15);
            --glass-border: rgba(255, 255, 255, 0.3);
            --primary: #010005;
            --secondary: #ff7675;
            --success: #55efc4;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }

        body {
            background: linear-gradient(135deg, #0e0c1a 0%, #141425 100%);
            min-height: 100vh;
            color: white;
            padding: 20px;
        }

        .wrapper {
            max-width: 1100px;
            margin: 0 auto;
        }

        /* Navbar Sederhana */
        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            padding: 20px;
            background: var(--glass);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid var(--glass-border);
        }

        .btn-back {
            text-decoration: none;
            color: white;
            font-size: 14px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: 0.3s;
        }

        .btn-back:hover { transform: translateX(-5px); color: var(--secondary); }

        /* judul_buku Section */
        .section-title {
            margin-bottom: 25px;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Grid Koleksi Buku */
        .book-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 25px;
        }

        /* Card Buku */
        .book-card {
            background: var(--glass);
            backdrop-filter: blur(15px);
            border: 1px solid var(--glass-border);
            border-radius: 25px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        .book-card:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .book-info {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .book-icon {
            width: 70px;
            height: 90px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 2rem;
            color: #f1c40f;
        }

        .book-details h3 { font-size: 1.2rem; margin-bottom: 5px; color: #fff; }
        .book-details p { font-size: 0.85rem; color: #dcdde1; }

        .date-info {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 15px;
            margin-bottom: 20px;
            font-size: 0.8rem;
            display: flex;
            justify-content: space-between;
        }

        .date-info span { display: block; color: #a29bfe; font-weight: 600; }

        /* Status & Button */
        .card-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }

        .badge {
            padding: 6px 15px;
            border-radius: 30px;
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
        }

        .status-active { background: #ffeaa7; color: #d35400; box-shadow: 0 0 15px rgba(255, 234, 167, 0.3); }
        .status-done { background: var(--success); color: #2d3436; }

        .btn-return {
            background: var(--secondary);
            border: none;
            padding: 10px 20px;
            border-radius: 12px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 13px;
            transition: 0.3s;
        }

        .btn-return:hover {
            background: #ff5252;
            box-shadow: 0 5px 15px rgba(255, 118, 117, 0.4);
        }

        /* Decorative Elements */
        .book-card::before {
            content: '';
            position: absolute;
            top: -50px;
            right: -50px;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
        }
    </style>
</head>
<body>

<div class="wrapper">
    <nav class="top-nav">
        <a href="test.php" class="btn-back"><i class="fas fa-arrow-left"></i> Dashboard</a>
        <div class="user">
            <i class="fas fa-user-circle"></i> Siswa Aktif
        </div>
    </nav>

    <h2 class="section-title"><i class="fas fa-book-reader" style="color: #f1c40f;"></i> Koleksi Buku Saya</h2>

    <div class="book-grid">
        
        <div class="book-card">
            <div class="book-info">
                <div class="book-icon"><i class="fas fa-book"></i></div>
                <div class="book-details">
                    <h3>Harry Potter</h3>
                    <p>J.K. Rowling</p>
                    <p><i class="fas fa-bookmark"></i> Fantasi</p>
                </div>
            </div>
            <div class="date-info">
                <div>Pinjam: <span>12 Jan 2026</span></div>
                <div style="text-align: right;">Batas Kembali: <span style="color: var(--secondary);">19 Jan 2026</span></div>
            </div>
            <div class="card-footer">
                <span class="badge status-active">Sedang Dipinjam</span>
                <button class="btn-return" onclick="alert('Buku berhasil diajukan pengembalian!')">Kembalikan</button>
            </div>
        </div>

        <div class="book-card" style="opacity: 0.8;">
            <div class="book-info">
                <div class="book-icon" style="color: #95afc0;"><i class="fas fa-check-circle"></i></div>
                <div class="book-details">
                    <h3>Bumi Manusia</h3>
                    <p>Pramoedya Ananta Toer</p>
                    <p><i class="fas fa-bookmark"></i> Sastra</p>
                </div>
            </div>
            <div class="date-info">
                <div>Pinjam: <span>01 Jan 2026</span></div>
                <div style="text-align: right;">Kembali Pada: <span>08 Jan 2026</span></div>
            </div>
            <div class="card-footer">
                <span class="badge status-done">Selesai Dikembalikan</span>
                <span style="font-size: 12px; color: #55efc4;"><i class="fas fa-star"></i> Tepat Waktu</span>
            </div>
        </div>

    </div>
</div>

</body>
</html>