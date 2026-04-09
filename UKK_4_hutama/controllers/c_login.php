<?php
require_once "../models/m_koneksi.php";

$db = new m_koneksi(); 
$mysql = $db->conn;    

// ===== ACTION LOGOUT =====
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_start();
    session_unset();
    session_destroy();
    echo "<script>
        alert('Anda telah keluar dari sistem!');
        window.location='../views/login.php';
    </script>";
    exit();
}

if (isset($_POST['login'])) {
    $username = mysqli_real_escape_string($mysql, $_POST['username']);
    $password = $_POST['password'];

    // 1. CEK QUERY: Pastikan nama tabel 'user' benar-benar ada di database kamu
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $exec  = mysqli_query($mysql, $query);
    
    // 2. DEBUGGING: Jika query gagal, tampilkan pesan error database-nya
    if (!$exec) {
        die("Query Error: " . mysqli_error($mysql));
    }

    if (mysqli_num_rows($exec) > 0) {
        $data = mysqli_fetch_assoc($exec);
        
        session_start();
        $_SESSION['id_user']  = $data['id_user']; 
        $_SESSION['username'] = $data['username'];
        $_SESSION['role']     = $data['role'];
        $_SESSION['status'] = $data['status_anggota'];
        $_SESSION['gabung']    = $data['tanggal_gabung'];
        $_SESSION['login']   = true;

        if($_SESSION['role'] === 'admin' ){
            echo "<script>
            alert('Halo Admin!');
            window.location='../views/public/admin/dashboard_admin.php';
        </script>";
        exit();
        }

        echo "<script>
            alert('Login Berhasil!');
            window.location='../views/public/test.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Username atau Password Salah!');
            window.location='../views/login.php';
        </script>";
    }
} else {
    header("Location: ../views/login.php");
    exit();
}


?>