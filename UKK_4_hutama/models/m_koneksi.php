<?php
class m_koneksi {
    // Deklarasi property yang rapi
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "db_perpustakaan";
    
    // Variabel ini yang bakal nyimpen koneksinya
    public $conn;

    function __construct() {
        // Bikin koneksi dan simpan ke $this->conn
        $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);

        // Cek kalau gagal
        if (!$this->conn) {
            die("Koneksi Error: " . mysqli_connect_error()); 
        }
        // Gak perlu return $this->conn di dalam __construct
    }
}
?>