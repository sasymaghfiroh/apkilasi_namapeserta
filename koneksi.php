<?php
$koneksi = mysqli_connect("localhost", "root", "", "penjualan_namapeserta");

if (mysqli_connect_errno()) {
    echo "Koneksi database gagal: " . mysqli_connect_error();
}
?>
