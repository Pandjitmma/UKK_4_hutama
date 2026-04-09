<?php
// Pastikan file koneksi sudah di-include
require_once 'm_koneksi.php';

class m_koneksi {

    public function tambahBuku($id_buku, $judul_buku, $pengarang, $penerbit, $stok) {
        $conn = new m_koneksi();
        // 1. Menyiapkan Query dengan Prepared Statements (Lebih Aman dari SQL Injection)
        $sql = "INSERT INTO buku VALUES ($id_buku, '$judul_buku', '$pengarang', '$penerbit', $stok)";

        
        // 2. Menggunakan properti $conn dari parent class m_koneksi
        $post = mysqli_query($conn->conn, $sql);

        // 3. Bind parameter (s = string, i = integer)
    if($post){
        echo"
        <script>
            alert('data berhasil ditambahkan');
            window.location='../public/lisbuku_user.php'
            </script";
    }
    else{
        echo "
        <script>;
        alert('gagal');
        window.location='../admin.php/tambah_buku.php'
        </script>";
    }
}
}