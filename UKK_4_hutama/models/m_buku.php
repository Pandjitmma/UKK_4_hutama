<?php

include_once 'm_koneksi.php';

class listbuku {
    function ambil_data(){

    $conn = new m_koneksi();
    $sql = "SELECT * FROM buku";
    $stmt = mysqli_query($conn->conn, $sql);

    if($stmt->num_rows > 0){
        while($row = mysqli_fetch_object($stmt)){
            $result[] = $row;
        }
        return $result;
    } else {
        echo 'kosong';
    }
    }
    function ambil_data_by_id($id){

    $conn = new m_koneksi();
    $sql = "SELECT * FROM buku WHERE id_buku = $id";
    $stmt = mysqli_query($conn->conn, $sql);
     if ($stmt->num_rows > 0) {
            while ($data = mysqli_fetch_assoc($stmt)) {
                $result[] = $data;
            }
            return $result;
        } else {
            echo "tidak ada data";
        }
    }
    
   function tambah_data($id_buku, $judul_buku, $pengarang, $penerbit, $stok, $kategori, $sinopsis) {
    $conn = new m_koneksi();
    
    // PERBAIKAN: Gunakan prepared statements untuk keamanan
    $sql = "INSERT INTO buku (id_buku, judul_buku, pengarang, penerbit, stok, kategori, sinopsis) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    // Persiapkan statement
    $stmt = $conn->conn->prepare($sql);
    
    if($stmt) {
        // Bind parameter
        $stmt->bind_param("ssssiss", $id_buku, $judul_buku, $pengarang, $penerbit, $stok, $kategori, $sinopsis);
        
        if($stmt->execute()) {
            // PERBAIKAN: Redirect dengan header atau echo script
            echo "<script>
                    window.location.href = '../views/public/admin/lisbuku.php';
                  </script>";
        } else {
            echo "<script>alert('tambah gagal: " . $stmt->error . "')</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->conn->error . "')</script>";
    }
}
function update_data($id_buku, $judul_buku, $pengarang, $penerbit, $stok, $kategori, $sinopsis){
    $conn = new m_koneksi();
    $sql = "UPDATE buku SET judul_buku = ?, pengarang = ?, penerbit = ?, stok = ?, kategori = ?, sinopsis = ? WHERE id_buku = ?";
    
    $stmt = $conn->conn->prepare($sql);
    
    if($stmt) {
        // Bind parameter (s = string, i = integer)
        $stmt->bind_param("sssisss", $judul_buku, $pengarang, $penerbit, $stok, $kategori, $sinopsis, $id_buku);
        
        if($stmt->execute()) {
            echo "<script>alert('Data Berhasil Diubah');window.location='../views/public/admin/lisbuku.php'</script>";
        } else {
            echo "<script>alert('Data Tidak Berhasil Diubah: " . $stmt->error . "')</script>";
        }
        $stmt->close();
    } else {
        echo "<script>alert('Error preparing statement: " . $conn->conn->error . "')</script>";
    }
}
function delete_data($id_buku){
    $conn = new m_koneksi();
$sql = "DELETE FROM buku WHERE id_buku = $id_buku ";
$query = mysqli_query($conn->conn, $sql);
if($query){
    echo "<script>alert('Data Berhasil Dihapus');window.location='../views/public/admin/lisbuku.php'</script>";
} else {
    echo "<script>alert('Data Tidak Berhasil Dihapus: " . mysqli_error($conn->conn) . "')</script>";
}
}
}