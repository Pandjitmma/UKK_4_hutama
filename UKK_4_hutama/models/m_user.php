<?php
include_once "m_koneksi.php";

class anggota extends m_koneksi {

    // Mengambil semua data user
    function ambil_data(){
        $sql = "SELECT * FROM users";
        $stmt = $this->conn->query($sql); // Pakai $this->conn karena sudah extends

        if($stmt->num_rows > 0){
            $result = [];
            while($row = $stmt->fetch_object()){
                $result[] = $row;
            }
            return $result;
        } else {
            return false;
        }
    }

    // Fungsi Registrasi / Tambah Data
    function tambah_data($nama_lengkap, $username, $password, $role, $status_anggota){
        // Gunakan prepared statement agar aman dari hacker
        $sql = "INSERT INTO users (nama_lengkap, username, password, role, status_anggota) 
                VALUES (?, ?, ?, ?, ?)";
        
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("sssss", $nama_lengkap, $username, $password, $role, $status_anggota);

        if($stmt->execute()) {
            echo "<script>
                alert('Registrasi Berhasil!');
                window.location='../views/login.php';
            </script>";
        } else {
            echo "Error: " . $this->conn->error;
        }
    }

    public function approveMember($id_user) {
        $sql = "UPDATE users SET status_anggota = 'true' WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }

    public function getPendingMembers() {
        $sql = "SELECT * FROM users WHERE role = 'siswa' AND status_anggota = 'false'";
        return $this->conn->query($sql);
    }

    public function getActiveMembers() {
        $sql = "SELECT * FROM users WHERE role = 'siswa' AND status_anggota = 'true'";
        return $this->conn->query($sql);
    }

    // Narik 1 data user berdasarkan ID untuk ditampilin di form edit
    public function get_user_by_id($id_user) {
        $sql = "SELECT * FROM users WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result->fetch_object(); // Pakai fetch_object biar seragam sama ambil_data()
    }

    // Eksekusi query UPDATE ke database
    public function edit_data($id_user, $nama_lengkap, $username, $password, $role, $status_anggota) {
        $sql = "UPDATE users SET nama_lengkap = ?, username = ?, password = ?, role = ?, status_anggota = ? WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        
        // "sssssi" artinya: String, String, String, String, String, Integer (untuk id_user)
        $stmt->bind_param("sssssi", $nama_lengkap, $username, $password, $role, $status_anggota, $id_user);
        
        return $stmt->execute();
    }

    public function hapus_data($id_user) {
        $sql = "DELETE FROM users WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        return $stmt->execute();
    }

    public function ambil_data_user($id_user) {
        $sql = "SELECT * FROM users WHERE id_user = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $id_user);
        $stmt->execute();
        return $stmt->get_result()->fetch_object();
    }
}
?>