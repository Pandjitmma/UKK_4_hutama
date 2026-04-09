<?php
include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
// Pastikan session_start() sudah ada di c_buku.php agar id_user bisa terbaca
include "../../controllers/c_buku.php"; 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koleksi Buku | E-Perpus</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --white: #ffffff;
            --text-dark: #1e293b;
            --text-light: #64748b;
        }

        * { box-sizing: border-box; font-family: 'Inter', sans-serif; }
        body { background-color: var(--bg); color: var(--text-dark); margin: 0; padding: 20px; }
        
        .main-content { max-width: 1100px; margin: 0 auto; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        
        /* Search Box */
        .search-container { position: relative; width: 300px; }
        .search-container i { position: absolute; left: 12px; top: 50%; transform: translateY(-50%); color: var(--text-light); }
        .search-container input { width: 100%; padding: 10px 10px 10px 40px; border-radius: 10px; border: 1px solid #ddd; outline: none; }

        /* Grid Buku */
        .book-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px; }
        .book-card { background: var(--white); border-radius: 15px; padding: 20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: 0.3s; cursor: pointer; text-align: center; }
        .book-card:hover { transform: translateY(-5px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .book-img { font-size: 3rem; color: var(--primary); margin-bottom: 15px; }
        .book-info h3 { font-size: 1.1rem; margin: 5px 0; }
        .book-info p { font-size: 0.9rem; color: var(--text-light); }
        .stock { font-size: 0.8rem; font-weight: bold; color: var(--primary); }

        /* Modal */
        .modal { display: none; position: fixed; z-index: 100; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); }
        .modal-content { background: white; margin: 10% auto; padding: 30px; border-radius: 20px; width: 90%; max-width: 500px; position: relative; }
        .close { position: absolute; right: 20px; top: 15px; font-size: 1.5rem; cursor: pointer; color: var(--text-light); }
        
        .modal-footer { margin-top: 25px; padding-top: 15px; border-top: 1px solid #eee; display: flex; justify-content: space-between; align-items: center; }
        .btn-submit-pinjam { background: var(--primary); color: white; border: none; padding: 10px 25px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-submit-pinjam:hover { background: var(--primary-hover); }
    </style>
</head>
<body>

<div class="main-content">
    <div class="header">
        <h1>📚 Koleksi Inventaris Buku</h1>
        <div class="search-container">
            <i class="fas fa-search"></i>
            <input type="text" id="searchInput" placeholder="Cari judul buku..." onkeyup="searchBook()">
        </div>
    </div>

    <div class="book-grid" id="bookGrid">
        <?php if(isset($data) && !empty($data)): ?>
            <?php foreach($data as $result): ?>
                <div class="book-card" onclick="openDetail(
                    '<?= addslashes($result->judul_buku) ?>', 
                    '<?= addslashes($result->pengarang) ?>', 
                    '<?= addslashes($result->sinopsis) ?>', 
                    '<?= $result->stok ?>',
                    '<?= $result->id_buku ?>'
                )">
                    <div class="book-img"><i class="fas fa-book"></i></div>
                    <div class="book-info">
                        <h3><?= $result->judul_buku ?></h3>
                        <p><i class="fas fa-user-edit"></i> <?= $result->pengarang ?></p>
                        <span class="stock">Tersedia: <?= $result->stok ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="text-align: center; width: 100%;">Data buku tidak ditemukan.</p>
        <?php endif; ?>
    </div>
</div>

<div id="bookModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-header" style="text-align: center; margin-bottom: 20px;">
            <i class="fas fa-book-open" style="font-size: 2.5rem; color: var(--primary);"></i>
            <h2 id="mTitle" style="margin: 10px 0 5px 0;"></h2>
            <p id="mAuthor" style="color: var(--text-light); font-style: italic;"></p>
        </div>
        <div class="modal-body">
            <p><strong>Sinopsis:</strong></p>
            <p id="mSynopsis" style="line-height: 1.6; color: #334155; font-size: 0.95rem;"></p>
            
            <div class="modal-footer">
                <span>Stok: <b id="mStock" style="color: var(--primary);"></b></span>
                
                <form action="tambah_pinjam.php" method="POST">
                    <input type="hidden" name="id_buku" id="mIdBuku">
                    <button type="submit" name="tambah" class="btn-submit-pinjam">
                        <i class="fas fa-hand-holding"></i> Ajukan Peminjaman
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function searchBook() {
        let input = document.getElementById('searchInput').value.toLowerCase();
        let cards = document.getElementsByClassName('book-card');
        for (let i = 0; i < cards.length; i++) {
            let title = cards[i].querySelector('h3').innerText.toLowerCase();
            cards[i].style.display = title.includes(input) ? "block" : "none";
        }
    }

    function openDetail(title, author, synopsis, stock, id) {
        document.getElementById('mTitle').innerText = title;
        document.getElementById('mAuthor').innerText = "Penulis: " + author;
        document.getElementById('mSynopsis').innerText = synopsis || "Tidak ada sinopsis untuk buku ini.";
        document.getElementById('mStock').innerText = stock;
        document.getElementById('mIdBuku').value = id; 
        document.getElementById('bookModal').style.display = "block";
    }

    function closeModal() {
        document.getElementById('bookModal').style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == document.getElementById('bookModal')) {
            closeModal();
        }
    }
</script>
</body>
</html>