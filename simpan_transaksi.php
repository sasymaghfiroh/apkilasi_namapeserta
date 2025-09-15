<?php
include 'koneksi.php';

// Menangkap data dari form
$kode_brg = mysqli_real_escape_string($koneksi, $_POST['kode_brg']);
$jml_brg = (int)$_POST['Jml_brg'];
$tgl_transaksi = mysqli_real_escape_string($koneksi, $_POST['Tgl_transaksi']);
$status = 'terjual'; // Status default untuk penjualan

// Memulai transaction
mysqli_begin_transaction($koneksi);

try {
    // 1. Ambil informasi stok terakhir dari database untuk validasi
    $sql_cek_stok = "SELECT Stok_brg FROM barang WHERE kode_brg = '$kode_brg' FOR UPDATE";
    $hasil_cek_stok = mysqli_query($koneksi, $sql_cek_stok);

    if (mysqli_num_rows($hasil_cek_stok) == 0) {
        throw new Exception("Barang tidak ditemukan.");
    }

    $data_stok = mysqli_fetch_assoc($hasil_cek_stok);
    $stok_saat_ini = $data_stok['Stok_brg'];

    // 2. Validasi apakah stok mencukupi
    if ($stok_saat_ini < $jml_brg) {
        throw new Exception("Stok tidak mencukupi untuk melakukan transaksi.");
    }

    // 3. Kurangi stok barang
    $stok_baru = $stok_saat_ini - $jml_brg;
    $sql_update_stok = "UPDATE barang SET Stok_brg = '$stok_baru' WHERE kode_brg = '$kode_brg'";
    $hasil_update = mysqli_query($koneksi, $sql_update_stok);

    if (!$hasil_update) {
        throw new Exception("Gagal mengupdate stok barang.");
    }

    // 4. Simpan data transaksi
    $sql_insert_transaksi = "INSERT INTO transaksi (Kode_brg, Jml_brg, Tgl_transaksi, status) VALUES ('$kode_brg', '$jml_brg', '$tgl_transaksi', '$status')";
    $hasil_insert = mysqli_query($koneksi, $sql_insert_transaksi);

    if (!$hasil_insert) {
        throw new Exception("Gagal menyimpan data transaksi.");
    }

    // Jika semua query berhasil, commit transaksi
    mysqli_commit($koneksi);

    // Redirect ke halaman riwayat transaksi
    header("Location: transaksi.php?status=sukses");
    exit();
} catch (Exception $e) {
    // Jika terjadi error, rollback semua perubahan
    mysqli_rollback($koneksi);

    // Tampilkan pesan error
    echo "<!DOCTYPE html><html><head><title>Transaksi Gagal</title><script src='https://cdn.tailwindcss.com'></script></head><body class='bg-gray-100 flex items-center justify-center h-screen'>";
    echo "<div class='bg-white p-8 rounded-lg shadow-lg text-center'>";
    echo "<h2 class='text-2xl font-bold text-red-600 mb-4'>Transaksi Gagal</h2>";
    echo "<p class='text-gray-700'>Terjadi kesalahan: " . $e->getMessage() . "</p>";
    echo "<a href='index.php' class='mt-6 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded'>Kembali ke Daftar Barang</a>";
    echo "</div></body></html>";
}

mysqli_close($koneksi);
