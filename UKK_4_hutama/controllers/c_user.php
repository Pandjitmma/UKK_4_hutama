<?php
// controllers/c_user.php
require_once "../models/m_user.php"; 

$kon = new anggota();

// ===== ACTION ADD (TAMBAH USER) =====
if(isset($_GET['action']) && $_GET['action'] == 'add') {
    $nama_lengkap   = $_POST['nama_lengkap'];
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $role           = $_POST['role'];
    $status_anggota = $_POST['status_anggota'];

    $eksekusi = $kon->tambah_data($nama_lengkap, $username, $password, $role, $status_anggota);

    if($eksekusi) {

        if(isset($_GET['type']) && $_GET['type'] == 'back') {
            echo "<script>
                alert('Pendaftaran berhasil! Silakan tunggu konfirmasi admin untuk aktivasi akun.');
                window.location='../views/public/admin/tambah_user.php';
            </script>";
            exit();

        } else {
             echo "<script>
            alert('User berhasil ditambahkan!');
            window.location='../views/public/admin/data_user.php';
        </script>";
        }
       
    } else {
        echo "<script>
            alert('Gagal menambahkan user!');
            window.history.back();
        </script>";
    }
    exit();
}

// ===== ACTION UPDATE (EDIT USER) =====
if(isset($_GET['action']) && $_GET['action'] == 'update') {
    $id_user        = $_POST['id_user'];
    $nama_lengkap   = $_POST['nama_lengkap'];
    $username       = $_POST['username'];
    $password       = $_POST['password'];
    $role           = $_POST['role'];
    $status_anggota = $_POST['status_anggota'];

    $eksekusi = $kon->edit_data($id_user, $nama_lengkap, $username, $password, $role, $status_anggota);

    if($eksekusi) {
        echo "<script>
            alert('Data user berhasil diperbarui!');
            window.location='../views/public/admin/data_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal memperbarui data!');
            window.history.back();
        </script>";
    }
    exit();
}

// ===== ACTION HAPUS (DELETE USER) =====
if(isset($_GET['action']) && $_GET['action'] == 'hapus') {
    $id_user = $_GET['id'];

    $eksekusi = $kon->hapus_data($id_user);

    if($eksekusi) {
        echo "<script>
            alert('User berhasil dihapus!');
            window.location='../views/public/admin/data_user.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus user!');
            window.history.back();
        </script>";
    }
    exit();
}

// Redirect ke halaman user jika tidak ada action
header("Location: ../views/public/admin/data_user.php");
exit();