<?php 
    include_once "../../controllers/AuthController.php";
    use App\auth\guard;
    guard::gate();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengembalian Buku | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #22c55e;
            --danger: #ef4444;
            --info: #3b82f6;
            --bg: #f1f5f9;
            --white: #ffffff;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            margin: 0;
            padding: 20px;
        }

        .admin-container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--white);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #f8fafc;
            padding: 15px;
            text-align: left;
            font-size: 0.8rem;
            text-transform: uppercase;
            color: #64748b;
            border-bottom: 2px solid #e2e8f0;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 0.9rem;
        }

        /* Status Badge Styling */
        .badge {
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
        }

        .borrowed { background: #dbeafe; color: #1e40af; } /* Sedang Dipinjam */
        .finished { background: #dcfce7; color: #166534; } /* Selesai */

        /* Action Buttons */
        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn {
            border: none;
            padding: 8px 15px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }

        .btn-return { background-color: var(--primary); color: white; }
        .btn-return:hover { background-color: #4338ca; }

        tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="admin-container">
    <div class="header">
        <h2><i class="fas fa-undo-alt"></i> Kelola Pengembalian Buku</h2>
    </div>

    <table>
        <thead>
            <tr>
                <th>Peminjam</th>
                <th>Judul Buku</th>
                <th>Tgl Pinjam</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><strong>Mochammad Pandji</strong></td>
                <td>Laskar Pelangi</td>
                <td>05 Mar 2026</td>
                <td><span class="badge borrowed">Sedang Dipinjam</span></td>
                <td>
                    <div class="btn-group">
                        <form action="proses_kembali.php" method="POST">
                            <input type="hidden" name="id_transaksi" value="101">
                            <button type="submit" class="btn btn-return">
                                <i class="fas fa-box-open"></i> Selesaikan
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            <tr>
                <td><strong>Hutama</strong></td>
                <td>Filosofi Teras</td>
                <td>01 Mar 2026</td>
                <td><span class="badge finished">Transaksi Selesai</span></td>
                <td>
                    <i class="fas fa-check-double" style="color: var(--success)"></i>
                </td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>