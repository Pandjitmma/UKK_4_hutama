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
    <title>Verifikasi Peminjaman | Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --success: #22c55e;
            --danger: #ef4444;
            --warning: #f59e0b;
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

        h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #1e293b;
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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

        .pending { background: #fef3c7; color: #92400e; }
        .approved { background: #dcfce7; color: #166534; }
        .rejected { background: #fee2e2; color: #991b1b; }

        /* Action Buttons */
        .btn-group {
            display: flex;
            gap: 8px;
        }

        .btn {
            border: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .btn-check { background-color: var(--success); color: white; }
        .btn-check:hover { background-color: #16a34a; }

        .btn-x { background-color: var(--danger); color: white; }
        .btn-x:hover { background-color: #dc2626; }

        tr:hover { background-color: #f8fafc; }
    </style>
</head>
<body>

<div class="admin-container">
    <h2><i class="fas fa-clipboard-check"></i> Verifikasi Transaksi Peminjaman</h2>

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
                <td>Filosofi Teras</td>
                <td>12 Mar 2026</td>
                <td><span class="badge pending">Menunggu Verifikasi</span></td>
                <td>
                    <div class="btn-group">
                        <form action="proses_verifikasi.php" method="POST">
                            <input type="hidden" name="id_transaksi" value="1">
                            <button name="aksi" value="terima" class="btn btn-check">
                                <i class="fas fa-check"></i> Terima
                            </button>
                        </form>
                        <form action="proses_verifikasi.php" method="POST">
                            <input type="hidden" name="id_transaksi" value="1">
                            <button name="aksi" value="tolak" class="btn btn-x">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        </form>
                    </div>
                </td>
            </tr>

            <tr>
                <td><strong>Hutama</strong></td>
                <td>Bumi Manusia</td>
                <td>10 Mar 2026</td>
                <td><span class="badge approved">Peminjaman Diterima</span></td>
                <td><i class="fas fa-minus" style="color:#cbd5e1"></i></td>
            </tr>
        </tbody>
    </table>
</div>

</body>
</html>