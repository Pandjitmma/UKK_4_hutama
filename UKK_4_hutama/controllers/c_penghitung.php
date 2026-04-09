<?php 
include_once __DIR__ . "/../models/m_penghitung.php";

$count = new count();
$total_anggota = $count->hitung_anggota();
$total_buku = $count->hitung_buku();
$total_peminjaman = $count->hitung_peminjaman();
?>