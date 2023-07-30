<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        #app {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1,
        h2 {
            color: #333;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            color: #ff5722;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="app">
        <h1>Edit Data Penjualan</h1>
        <form action="{{ route('penjualan.update', $penjualan->id) }}" method="post">
            @csrf
            @method('PUT')

            <label for="nama_barang">Nama Barang</label>
            <input type="text" name="nama_barang" value="{{ $penjualan->nama_barang }}" required>

            <label for="stok">Stok</label>
            <input type="number" name="stok" value="{{ $penjualan->stok }}" required>

            <label for="jumlah_terjual">Jumlah Terjual</label>
            <input type="number" name="jumlah_terjual" value="{{ $penjualan->jumlah_terjual }}" required>

            <label for="tanggal_transaksi">Tanggal Transaksi</label>
            <input type="date" name="tanggal_transaksi" value="{{ $penjualan->tanggal_transaksi }}" required>

            <label for="jenis_barang">Jenis Barang</label>
            <input type="text" name="jenis_barang" value="{{ $penjualan->jenis_barang }}" required>

            <button type="submit">Update Transaksi</button>
        </form>
    </div>
</body>

</html>
