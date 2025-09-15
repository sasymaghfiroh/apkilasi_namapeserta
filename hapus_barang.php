<?php
include 'koneksi.php';

// Memastikan kode_brg ada di URL
if (!isset($_GET['kode_brg'])) {
    header('Location: index.php');
    exit();
}

$kode_brg = mysqli_real_escape_string($koneksi, $_GET['kode_brg']);

// 1. Cek apakah barang ini pernah ada dalam transaksi
$sql_cek = "SELECT COUNT(*) as jumlah FROM transaksi WHERE Kode_brg = '$kode_brg'";
$hasil_cek = mysqli_query($koneksi, $sql_cek);
$data_cek = mysqli_fetch_assoc($hasil_cek);

if ($data_cek['jumlah'] > 0) {
    // Jika sudah ada di transaksi, jangan hapus. Tampilkan pesan.
    echo "<!DOCTYPE html><html><head><title>Gagal Menghapus</title><script src='https://cdn.tailwindcss.com'></script></head><body class='bg-gray-100 flex items-center justify-center h-screen'>";
    echo "<div class='bg-white p-8 rounded-lg shadow-lg text-center'>";
    echo "<h2 class='text-2xl font-bold text-red-600 mb-4'>Gagal Menghapus Barang</h2>";
    echo "<p class='text-gray-700'>Barang dengan kode <strong>" . htmlspecialchars($kode_brg) . "</strong> tidak dapat dihapus karena sudah memiliki riwayat transaksi.</p>";
    echo "<a href='index.php' class='mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Kembali ke Daftar Barang</a>";
    echo "</div></body></html>";
    mysqli_close($koneksi);
    exit();
}

// 2. Jika tidak ada di transaksi, lanjutkan proses hapus
$sql_hapus = "DELETE FROM barang WHERE kode_brg = '$kode_brg'";
$hasil_hapus = mysqli_query($koneksi, $sql_hapus);

if ($hasil_hapus) {
    // Jika berhasil, redirect ke halaman utama
    header("Location: index.php");
    exit();
} else {
    // Jika gagal, tampilkan pesan error
    echo "Gagal menghapus data barang. Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
