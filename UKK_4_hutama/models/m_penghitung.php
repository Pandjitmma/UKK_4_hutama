<?php 

    include_once "m_koneksi.php";

class count{
    private $conn;
    public function __construct() {
        $db = new m_koneksi();
        $this->conn = $db->conn;
    }

    public function hitung_anggota(){
        $sql = "SELECT COUNT(*) AS total_anggota FROM users";
        $result = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_object($result);
        return $result;
    }

    public function hitung_buku(){
        $sql = "SELECT SUM(stok) AS total_buku FROM buku";
        $result = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_object($result);
        return $result;
    }

    public function hitung_peminjaman(){
        $sql = "SELECT COUNT(*) AS total_peminjaman FROM transaksi WHERE status_transaksi = 'di pinjam'";
        $result = mysqli_query($this->conn, $sql);
        $result = mysqli_fetch_object($result);
        return $result;
    }
}

?>