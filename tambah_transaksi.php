<?php
include 'koneksi.php';

// Memastikan kode_brg ada di URL
if (!isset($_GET['kode_brg'])) {
    header('Location: index.php');
    exit();
}

$kode_brg = mysqli_real_escape_string($koneksi, $_GET['kode_brg']);

// Mengambil data barang untuk ditampilkan
$sql = "SELECT * FROM barang WHERE kode_brg = '$kode_brg'";
$hasil = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($hasil) == 0) {
    echo "Barang tidak ditemukan.";
    exit();
}

$barang = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi Penjualan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Catat Transaksi Penjualan</h1>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Formulir Transaksi</h2>

            <!-- Menampilkan info barang -->
            <div class="mb-6 bg-gray-50 p-4 rounded-md border">
                <h3 class="font-bold text-lg text-gray-700"><?php echo htmlspecialchars($barang['Nama_brg']); ?></h3>
                <p class="text-sm text-gray-600">Kode: <?php echo htmlspecialchars($barang['kode_brg']); ?></p>
                <p class="text-sm text-gray-600">Merk: <?php echo htmlspecialchars($barang['Merk_brg']); ?></p>
                <p class="text-sm text-gray-600">Harga Satuan: Rp <?php echo number_format($barang['Harga_brg'], 0, ',', '.'); ?></p>
                <p class="text-sm text-gray-600">Stok Tersedia: <strong id="stok_tersedia"><?php echo $barang['Stok_brg']; ?></strong></p>
            </div>

            <form action="simpan_transaksi.php" method="POST" onsubmit="return validasiStok()">
                <input type="hidden" name="kode_brg" value="<?php echo $barang['kode_brg']; ?>">
                <input type="hidden" name="harga_brg" value="<?php echo $barang['Harga_brg']; ?>">

                <div class="mb-4">
                    <label for="Jml_brg" class="block text-gray-700 text-sm font-bold mb-2">Jumlah Jual</label>
                    <input type="number" id="Jml_brg" name="Jml_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" min="1" max="<?php echo $barang['Stok_brg']; ?>" required>
                    <p id="error-message" class="text-red-500 text-xs italic mt-2 hidden">Jumlah melebihi stok yang tersedia.</p>
                </div>

                <div class="mb-6">
                    <label for="Tgl_transaksi" class="block text-gray-700 text-sm font-bold mb-2">Tanggal Transaksi</label>
                    <input type="datetime-local" id="Tgl_transaksi" name="Tgl_transaksi" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo date('Y-m-d\TH:i'); ?>" required>
                </div>

                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Transaksi
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function validasiStok() {
            const stokTersedia = parseInt(document.getElementById('stok_tersedia').innerText);
            const jumlahJual = parseInt(document.getElementById('Jml_brg').value);
            const errorMessage = document.getElementById('error-message');

            if (jumlahJual > stokTersedia) {
                errorMessage.classList.remove('hidden');
                return false; // Mencegah form disubmit
            }
            errorMessage.classList.add('hidden');
            return true; // Lanjutkan submit form
        }
    </script>

</body>
</html>
<?php mysqli_close($koneksi); ?>
