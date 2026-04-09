<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inventaris Buku | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --bg: #f8fafc;
            --text-main: #1e293b;
            --text-muted: #64748b;
            --border: #e2e8f0;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background-color: var(--bg);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .container {
            width: 100%;
            max-width: 1400px; /* Diperlebar agar menampung semua kolom */
            background: var(--white);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--bg);
            padding-bottom: 15px;
        }

        .header h2 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .table-wrapper {
            overflow-x: auto; /* Scroll horizontal jika layar sempit */
            border-radius: 8px;
            border: 1px solid var(--border);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: var(--white);
            min-width: 1100px; /* Mencegah kolom berhimpitan */
        }

        th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            border-bottom: 2px solid var(--border);
        }

        td {
            padding: 12px 10px;
            border-bottom: 1px solid var(--border);
            vertical-align: middle;
        }

        /* Styling Input agar rapi */
        input[type="text"], 
        input[type="number"], 
        textarea {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid var(--border);
            border-radius: 8px;
            font-size: 0.9rem;
            color: var(--text-main);
            transition: all 0.2s;
            box-sizing: border-box;
        }

        input:focus, textarea:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.1);
        }

        textarea {
            resize: vertical;
            min-height: 80px;
            line-height: 1.5;
        }

        /* Atur lebar spesifik tiap kolom */
        .col-judul { width: 180px; }
        .col-nama { width: 150px; }
        .col-stok { width: 80px; }
        .col-sinopsis { width: 300px; }
        .col-aksi { width: 100px; }

        .btn-save {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background 0.2s;
        }

        .btn-save:hover {
            background-color: var(--primary-hover);
        }

        tr:hover {
            background-color: #f8fafc;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <i class="fas fa-edit" style="color: var(--primary); font-size: 1.8rem;"></i>
        <h2>Edit Inventaris Buku</h2>
    </div>

    <div class="table-wrapper">
        <table>
            <thead>
                <tr>
                    <th class="col-judul">Judul Buku</th>
                    <th class="col-nama">Pengarang</th>
                    <th class="col-nama">Penerbit</th>
                    <th class="col-stok">Stok</th>
                    <th class="col-nama">Kategori</th>
                    <th class="col-sinopsis">Sinopsis</th>
                    <th class="col-aksi">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../../../models/m_buku.php';
                $db = new listbuku();
                $id = $_GET['id'];
                $data = $db->ambil_data_by_id($id);

                foreach ($data as $result) {
                    
                } ?>
                <tr>
                    <form action="../../../controllers/c_buku.php?action=update" method="POST">
                        <input type="hidden" name="id" value="<?= $result['id_buku'] ?>">
                        <td><input type="text" name="judul_buku" value="<?= htmlspecialchars($result['judul_buku']) ?>"></td>
                        <td><input type="text" name="pengarang" value="<?= htmlspecialchars($result['pengarang']) ?>"></td>
                        <td><input type="text" name="penerbit" value="<?= htmlspecialchars($result['penerbit']) ?>"></td>
                        <td><input type="number" name="stok" value="<?= $result['stok'] ?>"></td>
                        <td><input type="text" name="kategori" value="<?= htmlspecialchars($result['kategori']) ?>"></td>
                    <td><textarea><?= htmlspecialchars($result['sinopsis']) ?></textarea></td>
                    <td>
                        <button class="btn-save"><i class="fas fa-save"></i> Simpan</button>
                    </td>
                    </form>
                </tr>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>