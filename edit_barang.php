<?php
include 'koneksi.php';

// Mendapatkan kode_brg dari URL
if (!isset($_GET['kode_brg'])) {
    header('Location: index.php');
    exit();
}
$kode_brg = $_GET['kode_brg'];

// Mengambil data barang dari database
$sql = "SELECT * FROM barang WHERE kode_brg = '$kode_brg'";
$hasil = mysqli_query($koneksi, $sql);

if (mysqli_num_rows($hasil) == 0) {
    echo "Data barang tidak ditemukan.";
    exit();
}

$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Barang</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Edit Data Barang</h1>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Formulir Edit Barang</h2>
            <form action="update_barang.php" method="POST">
                <!-- Menyimpan kode barang asli dalam input tersembunyi -->
                <input type="hidden" name="kode_brg_asli" value="<?php echo $data['kode_brg']; ?>">

                <div class="mb-4">
                    <label for="kode_brg" class="block text-gray-700 text-sm font-bold mb-2">Kode Barang</label>
                    <input type="text" id="kode_brg" name="kode_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-200 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($data['kode_brg']); ?>" readonly>
                    <p class="text-xs text-gray-500 mt-1">Kode barang tidak dapat diubah.</p>
                </div>
                <div class="mb-4">
                    <label for="nama_brg" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                    <input type="text" id="nama_brg" name="nama_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($data['nama_brg']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="merk_brg" class="block text-gray-700 text-sm font-bold mb-2">Merk Barang</label>
                    <input type="text" id="merk_brg" name="merk_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($data['merk_brg']); ?>" required>
                </div>
                <div class="mb-4">
                    <label for="harga_brg" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang</label>
                    <input type="number" id="harga_brg" name="harga_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($data['harga_brg']); ?>" required>
                </div>
                <div class="mb-6">
                    <label for="stok_brg" class="block text-gray-700 text-sm font-bold mb-2">Stok Barang</label>
                    <input type="number" id="stok_brg" name="stok_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" value="<?php echo htmlspecialchars($data['stok_brg']); ?>" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Update Barang
                    </button>
                    <a href="index.php" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
<?php mysqli_close($koneksi); ?>
