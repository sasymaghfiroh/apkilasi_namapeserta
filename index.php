<?php
// Hubungkan ke database
include 'koneksi.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Stok Barang</title>
</head>
<body>
    <h2>Data Barang</h2>
    <a href="tambah_barang.php">Tambah Barang Baru</a>
    <br/><br/>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Opsi</th>
        </tr>
        <?php
        // Ambil data dari database
        $no = 1;
        $data = mysqli_query($koneksi, "SELECT * FROM barang");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $d['nama_barang']; ?></td>
                <td>Rp <?php echo number_format($d['harga']); ?></td>
                <td><?php echo $d['stok']; ?></td>
                <td>
                    <a href="edit_barang.php?id=<?php echo $d['id_barang']; ?>">EDIT</a>
                    <a href="hapus_barang.php?id=<?php echo $d['id_barang']; ?>">HAPUS</a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>
