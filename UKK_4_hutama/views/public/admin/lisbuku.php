<?php
include_once "../../../controllers/AuthController.php";
    use App\auth\guard;
    guard::adminOnly();
// Pastikan session_start() sudah ada di c_buku.php agar id_user bisa terbaca

include "../../../controllers/c_buku.php";



// JIKA ADA REQUEST HAPUS BUKU

if (isset($_GET['hapus'])) {

    // Kita asumsikan kamu memanggil koneksi database di sini untuk proses hapus

    // require_once "../../../models/m_koneksi.php";

    // $mysql = new m_koneksi();

    // $id_hapus = $_GET['hapus'];

    // mysqli_query($mysql->conn, "DELETE FROM buku WHERE id_buku = '$id_hapus'");

    // echo "<script>alert('Buku berhasil dihapus!'); window.location='nama_file_ini.php';</script>";

}

?>



<!DOCTYPE html>

<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kelola Koleksi Buku | E-Perpus</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        :root {

            /* Palet Warna Biru & Putih Modern */

            --primary: #2563eb;      

            --primary-hover: #1d4ed8;

            --secondary: #eff6ff;    

            --bg: #f4f7f9;            

            --white: #ffffff;

            --text-dark: #1e293b;    

            --text-light: #64748b;    

            --border-color: #e2e8f0;

            --danger: #ef4444;        /* Warna merah untuk hapus */

            --danger-hover: #dc2626;

            --shadow-sm: 0 1px 3px rgba(37, 99, 235, 0.1);

            --shadow-md: 0 4px 6px -1px rgba(37, 99, 235, 0.1), 0 2px 4px -1px rgba(37, 99, 235, 0.06);

            --shadow-lg: 0 10px 15px -3px rgba(37, 99, 235, 0.15), 0 4px 6px -2px rgba(37, 99, 235, 0.05);

        }



        * {

            box-sizing: border-box;

            font-family: 'Poppins', sans-serif;

        }

       

        body {

            background-color: var(--bg);

            color: var(--text-dark);

            margin: 0;

            padding: 30px 20px;

        }

       

        .main-content {

            max-width: 1100px;

            margin: 0 auto;

        }



        /* Bagian Header */

        .header {

            display: flex;

            justify-content: space-between;

            align-items: center;

            gap: 20px;

            margin-bottom: 40px;

            background: var(--white);

            padding: 20px 30px;

            border-radius: 15px;

            box-shadow: var(--shadow-sm);

            border-left: 5px solid var(--primary);

        }

       

        .header h1 {

            margin: 0;

            font-size: 1.8rem;

            color: var(--primary);

            font-weight: 600;

            flex: 1;

        }

        

        .header-actions {

            display: flex;

            gap: 10px;

            align-items: center;

        }

        

        .btn-tambah {

            background: var(--primary);

            color: var(--white);

            padding: 12px 24px;

            border-radius: 8px;

            text-decoration: none;

            font-weight: 600;

            font-size: 0.95rem;

            display: flex;

            align-items: center;

            gap: 8px;

            transition: all 0.3s ease;

            border: none;

            cursor: pointer;

        }

        

        .btn-tambah:hover {

            background: var(--primary-hover);

            transform: translateY(-2px);

            box-shadow: var(--shadow-md);

        }

       

        /* Search Box */

        .search-container {

            position: relative;

            width: 350px;

        }

        .search-container i {

            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: var(--primary);

        }

        .search-container input {

            width: 100%;

            padding: 12px 15px 12px 45px;

            border-radius: 25px;

            border: 1px solid var(--border-color);

            background-color: var(--secondary);

            outline: none;

            font-size: 0.95rem;

            transition: all 0.3s ease;

        }

        .search-container input:focus {

            border-color: var(--primary);

            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.2);

            background-color: var(--white);

        }



        /* Grid Buku */

        .book-grid {

            display: grid;

            grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));

            gap: 25px;

        }



        /* Kartu Buku */

        .book-card {

            background: var(--white);

            border-radius: 15px;

            padding: 25px 20px;

            box-shadow: var(--shadow-md);

            transition: all 0.3s ease;

            cursor: pointer;

            text-align: center;

            border: 1px solid transparent;

            position: relative;

            overflow: hidden;

            display: flex;

            flex-direction: column;

        }

       

        .book-card::before {

            content: '';

            position: absolute;

            top: 0;

            left: 0;

            width: 100%;

            height: 4px;

            background: var(--primary);

            opacity: 0;

            transition: 0.3s ease;

        }



        .book-card:hover {

            transform: translateY(-8px);

            box-shadow: var(--shadow-lg);

            border-color: var(--secondary);

        }



        .book-card:hover::before { opacity: 1; }



        .book-img {

            font-size: 3.5rem;

            color: var(--primary);

            margin-bottom: 20px;

            background: var(--secondary);

            width: 80px;

            height: 80px;

            line-height: 80px;

            border-radius: 50%;

            margin-left: auto;

            margin-right: auto;

        }



        .book-info h3 {

            font-size: 1.15rem;

            margin: 5px 0 10px 0;

            color: var(--text-dark);

            font-weight: 600;

        }

       

        .book-info p {

            font-size: 0.9rem;

            color: var(--text-light);

            margin: 5px 0;

        }

       

        .stock {

            display: inline-block;

            margin-top: 10px;

            font-size: 0.85rem;

            font-weight: 600;

            color: var(--primary);

            background-color: var(--secondary);

            padding: 5px 12px;

            border-radius: 20px;

        }



        /* CSS BARU: Tombol Edit & Hapus */

        .card-actions {

            margin-top: auto; /* Mendorong tombol ke bawah kartu */

            padding-top: 20px;

            display: flex;

            justify-content: center;

            gap: 10px;

        }



        .btn-action {

            padding: 8px 15px;

            border-radius: 8px;

            font-size: 0.85rem;

            font-weight: 600;

            text-decoration: none;

            color: white;

            transition: 0.2s;

            border: none;

            cursor: pointer;

            flex: 1;

        }



        .btn-edit { background: var(--primary); }

        .btn-edit:hover { background: var(--primary-hover); transform: translateY(-2px); }

       

        .btn-delete { background: var(--danger); }

        .btn-delete:hover { background: var(--danger-hover); transform: translateY(-2px); }



        /* Modal Background */

        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(5px); }

        .modal-content { background: var(--white); margin: 8% auto; padding: 35px; border-radius: 20px; width: 90%; max-width: 550px; position: relative; box-shadow: var(--shadow-lg); animation: fadeIn 0.4s ease-out; }

        @keyframes fadeIn { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }

        .close { position: absolute; right: 25px; top: 20px; font-size: 1.8rem; cursor: pointer; color: var(--text-light); transition: 0.2s; }

        .close:hover { color: #ef4444; }

       

        .modal-header i { background: var(--secondary); padding: 20px; border-radius: 50%; margin-bottom: 15px; }

        .modal-body p strong { color: var(--text-dark); font-size: 1rem; }

        .modal-footer { margin-top: 30px; padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; }

       

        @media (max-width: 768px) {

            .header { 

                flex-direction: column; 

                align-items: stretch; 

                gap: 15px; 

            }

            .header-actions {

                flex-direction: column;

            }

            .search-container { width: 100%; }

            .btn-tambah {

                width: 100%;

                justify-content: center;

            }

        }

    </style>

</head>

<body>



<div class="main-content">

    <div class="header">

        <h1><i class="fas fa-books" style="margin-right: 10px;"></i> Kelola Buku</h1>

        <div class="header-actions">

            <div class="search-container">

                <i class="fas fa-search"></i>

                <input type="text" id="searchInput" placeholder="Cari judul buku..." onkeyup="searchBook()">

            </div>

            <a href="tambah_buku.php" class="btn-tambah">

                <i class="fas fa-plus"></i> Tambah Buku

            </a>

        </div>

    </div>



    <div class="book-grid" id="bookGrid">

        <?php if(isset($data) && !empty($data)): ?>

            <?php foreach($data as $result): ?>

                <div class="book-card">

                    <div onclick="openDetail(

                        '<?= addslashes($result->judul_buku) ?>',

                        '<?= addslashes($result->pengarang) ?>',

                        '<?= addslashes($result->sinopsis) ?>',

                        '<?= $result->stok ?>',

                        '<?= $result->id_buku ?>'

                    )">

                        <div class="book-img"><i class="fas fa-book"></i></div>

                        <div class="book-info">

                            <h3><?= $result->judul_buku ?></h3>

                            <p><i class="fas fa-pen-nib"></i> <?= $result->pengarang ?></p>

                            <span class="stock">Tersedia: <?= $result->stok ?></span>

                        </div>

                    </div>

                   

                    <div class="card-actions">

                        <a href="editdata_listbuku.php?id=<?= $result->id_buku ?>" class="btn-action btn-edit">

                            <i class="fas fa-edit"></i> Edit

                        </a>

                       

                        <a href="../../../controllers/c_buku.php?action=delete&id=<?= $result->id_buku ?>" class="btn-action btn-delete" onclick="return confirm('Yakin ingin menghapus buku ini dari database?');">

                            <i class="fas fa-trash"></i> Hapus

                        </a>

                    </div>

                </div>

            <?php endforeach; ?>

        <?php else: ?>

            <div style="grid-column: 1 / -1; text-align: center; padding: 40px; background: var(--white); border-radius: 15px;">

                <i class="fas fa-folder-open" style="font-size: 3rem; color: var(--text-light); margin-bottom: 15px;"></i>

                <p style="color: var(--text-light); font-size: 1.1rem;">Belum ada data buku yang tersedia saat ini.</p>

            </div>

        <?php endif; ?>

    </div>

</div>



<div id="bookModal" class="modal">

    <div class="modal-content">

        <span class="close" onclick="closeModal()">&times;</span>

        <div class="modal-header" style="text-align: center; margin-bottom: 25px;">

            <i class="fas fa-book-open" style="font-size: 2.5rem; color: var(--primary);"></i>

            <h2 id="mTitle" style="margin: 15px 0 5px 0; color: var(--text-dark);"></h2>

            <p id="mAuthor" style="color: var(--primary); font-weight: 500;"></p>

        </div>

        <div class="modal-body">

            <p><strong>Sinopsis:</strong></p>

            <p id="mSynopsis" style="line-height: 1.7; color: var(--text-light); font-size: 0.95rem; text-align: justify;"></p>

           

            <div class="modal-footer">

                <span>Stok Buku: <b id="mStock" style="color: var(--primary); font-size: 1.2rem;"></b></span>

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

</body