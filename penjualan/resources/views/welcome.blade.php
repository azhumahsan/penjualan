<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Penjualan</title>
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


   h1, h2 {
     color: #333;
   }


   table {
     width: 100%;
     border-collapse: collapse;
     margin-top: 20px;
   }


   th, td {
     padding: 10px;
     text-align: left;
     border-bottom: 1px solid #ccc;
   }


   tr:hover {
     background-color: #f9f9f9;
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
    <h1>Data Penjualan</h1>
    <form action="{{ route('penjualan.store') }}" method="post">
      @csrf
      
      <label for="nama_barang">Nama Barang</label>
     <input type="text" name="nama_barang" required>


     <label for="stok">Stok</label>
     <input type="number" name="stok" required>


     <label for="jumlah_terjual">Jumlah Terjual</label>
     <input type="number" name="jumlah_terjual" required>


     <label for="tanggal_transaksi">Tanggal Transaksi</label>
     <input type="date" name="tanggal_transaksi" required>


     <label for="jenis_barang">Jenis Barang</label>
     <input type="text" name="jenis_barang" required>


     <button type="submit">Tambahkan Transaksi</button>
     <p v-if="message" class="message"></p>
     
    </form>

    <div>
      <label for="filter">Filter:</label>
      <input type="text" name="filterText" @input="filterTransactions" id="filter" placeholder="Cari transaksi..."> 
    </div>

    <h2>Daftar Transaksi</h2>
    <table>
    
      <tr>
        <th >Nama Barang</th>
        <th >Stok</th>
        <th >Jumlah Terjual</th>
        <th >Tanggal Transaksi</th>
        <th >Jenis Barang</th>
        <th>Aksi</th>
      </tr>
      
      @foreach($data as $items)
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td>
          <button>Hapus</button>
          <button>Lihat Detail</button>
          <button>Edit</button>
        </td>
      </tr>
      @endforeach
    </table>
  </div>
    </body>

</html>