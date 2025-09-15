<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-blue-600 text-white p-4 shadow-md">
        <div class="container mx-auto">
            <h1 class="text-2xl font-bold">Tambah Barang Baru</h1>
        </div>
    </nav>

    <div class="container mx-auto mt-8">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Formulir Data Barang</h2>
            <form action="simpan_barang.php" method="POST">
                <div class="mb-4">
                    <label for="kode_brg" class="block text-gray-700 text-sm font-bold mb-2">Kode Barang</label>
                    <input type="text" id="kode_brg" name="kode_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="nama_brg" class="block text-gray-700 text-sm font-bold mb-2">Nama Barang</label>
                    <input type="text" id="nama_brg" name="nama_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="merk_brg" class="block text-gray-700 text-sm font-bold mb-2">Merk Barang</label>
                    <input type="text" id="merk_brg" name="merk_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-4">
                    <label for="harga_brg" class="block text-gray-700 text-sm font-bold mb-2">Harga Barang</label>
                    <input type="number" id="harga_brg" name="harga_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="mb-6">
                    <label for="stok_brg" class="block text-gray-700 text-sm font-bold mb-2">Stok Barang</label>
                    <input type="number" id="stok_brg" name="stok_brg" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                </div>
                <div class="flex items-center justify-between">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Barang
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
