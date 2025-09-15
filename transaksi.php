<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-2xl font-bold">SI Penjualan</h1>
            <div>
                <a href="index.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700">Data Barang</a>
                <a href="transaksi.php" class="px-3 py-2 rounded-md text-sm font-medium hover:bg-blue-700 bg-blue-700">Riwayat Transaksi</a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">Riwayat Transaksi Penjualan</h2>

            <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">Transaksi baru berhasil disimpan.</span>
            </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white">
                    <thead class="bg-gray-800 text-white">
                        <tr>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Kode Transaksi</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Tanggal</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama Barang</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Merk</th>
                            <th class="text-center py-3 px-4 uppercase font-semibold text-sm">Jumlah</th>
                            <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Status</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php
                        include 'koneksi.php';
                        $sql = "SELECT
                                    t.kode_transaksi,
                                    t.Tgl_transaksi,
                                    t.Jml_brg,
                                    t.status,
                                    b.nama_brg,
                                    b.merk_brg
                                FROM
                                    transaksi t
                                JOIN
                                    barang b ON t.Kode_brg = b.kode_brg
                                ORDER BY
                                    t.Tgl_transaksi DESC";

                        $hasil = mysqli_query($koneksi, $sql);

                        if (mysqli_num_rows($hasil) > 0) {
                            while ($data = mysqli_fetch_assoc($hasil)) {
                        ?>
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-4"><?php echo $data['kode_transaksi']; ?></td>
                                    <td class="py-3 px-4"><?php echo date('d-m-Y H:i', strtotime($data['Tgl_transaksi'])); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($data['nama_brg']); ?></td>
                                    <td class="py-3 px-4"><?php echo htmlspecialchars($data['merk_brg']); ?></td>
                                    <td class="py-3 px-4 text-center"><?php echo $data['Jml_brg']; ?></td>
                                    <td class="py-3 px-4">
                                        <span class="bg-green-200 text-green-800 py-1 px-3 rounded-full text-xs"><?php echo htmlspecialchars($data['status']); ?></span>
                                    </td>
                                </tr>
                        <?php
                            }
                        } else {
                        ?>
                            <tr>
                                <td colspan="6" class="py-4 px-4 text-center text-gray-500">Belum ada riwayat transaksi.</td>
                            </tr>
                        <?php
                        }
                        mysqli_close($koneksi);
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
