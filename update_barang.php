<?php
include 'koneksi.php';

// Menangkap data yang dikirim dari form
$kode_brg_asli = mysqli_real_escape_string($koneksi, $_POST['kode_brg_asli']);
$nama_brg = mysqli_real_escape_string($koneksi, $_POST['nama_brg']);
$merk_brg = mysqli_real_escape_string($koneksi, $_POST['merk_brg']);
$harga_brg = (int)$_POST['harga_brg'];
$stok_brg = (int)$_POST['stok_brg'];

// Query untuk mengupdate data di database
$sql = "UPDATE barang SET
            nama_brg = '$nama_brg',
            merk_brg = '$merk_brg',
            harga_brg = '$harga_brg',
            stok_brg = '$stok_brg'
        WHERE kode_brg = '$kode_brg_asli'";

$hasil = mysqli_query($koneksi, $sql);

// Cek keberhasilan query
if ($hasil) {
    // Jika berhasil, redirect ke halaman utama
    header("Location: index.php");
    exit();
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal mengupdate data barang. Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>