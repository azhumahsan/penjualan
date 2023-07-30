<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penjualan</title>
    <style>
        /* Gaya tampilan CSS */
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
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

        /* Gaya untuk anchor "Edit" */
        a.edit-link {
            display: inline-block;
            background-color: #2196F3;
            color: white;
            padding: 10px 28px;
            border-radius: 5px;
            text-decoration: none;
            margin-right: 5px;
            font-size:13px;
        }

        a.edit-link:hover {
            background-color: #0b7dda;
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
            <label for="search">Search:</label>
            <input type="text" name="search" id="search" placeholder="Search....">
            <button id="searchButton">Search</button>
            <button id="clearButton">Clear</button>
            <button id="btnSort" onclick="sortData()">=</button>
        </div>


        <h2>Daftar Transaksi</h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Barang</th>
                    <th>Stok</th>
                    <th>Terjual</th>
                    <th>Tanggal Transaksi</th>
                    <th>Jenis Barang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tableBody">

                @foreach($data as $item)
                <tr>
                    <td>{{$item->nama_barang}}</td>
                    <td>{{$item->stok}}</td>
                    <td>{{$item->jumlah_terjual}}</td>
                    <td>{{$item->tanggal_transaksi}}</td>
                    <td>{{$item->jenis_barang}}</td>
                    <td>
                        <form action="{{ route('penjualan.destroy', $item->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Hapus</button>
                        </form>
                        <a href="{{ route('penjualan.edit', $item->id) }}" class="edit-link">Edit</a>
                    </td>
                </tr>
                @endforeach
        </table>
    </div>

    <script>
        let sortOrder = '';

        function sortData() {
            const btnSort = document.getElementById('btnSort');

            if (sortOrder === '') {
                sortOrder = 'desc';
                btnSort.innerText = '+';
            } else if (sortOrder === 'desc') {
                sortOrder = 'asc';
                btnSort.innerText = '-';
            } else {
                sortOrder = '';
                btnSort.innerText = '=';
            }

            filterAndSortData();
        }

        function filterAndSortData() {
            const table = document.querySelector('table');
            const rows = Array.from(table.getElementsByTagName('tr'));
            const headerRow = rows.shift();

            const dataRows = rows.filter(row => row.style.display !== 'none');
            const sortedDataRows = sortRows(dataRows);

            // Sisipkan kembali baris data yang sudah diurutkan
            table.innerHTML = '';
            table.appendChild(headerRow);
            sortedDataRows.forEach(row => table.appendChild(row));
        }

        function sortRows(rows) {
            if (sortOrder === '') {
                return rows;
            }

            return rows.sort((rowA, rowB) => {
                const cellA = rowA.getElementsByTagName('td')[2]; // Kolom Jumlah Terjual
                const cellB = rowB.getElementsByTagName('td')[2];
                const valueA = parseInt(cellA.textContent || cellA.innerText, 10);
                const valueB = parseInt(cellB.textContent || cellB.innerText, 10);

                if (sortOrder === 'desc') {
                    return valueB - valueA;
                } else if (sortOrder === 'asc') {
                    return valueA - valueB;
                }
            });
        }

        function filterTransactions() {
            const input = document.getElementById('filter');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const rowData = row.getElementsByTagName('td');
                let shouldDisplay = false;

                for (let j = 0; j < rowData.length; j++) {
                    const cellData = rowData[j];
                    if (cellData) {
                        const textValue = cellData.textContent || cellData.innerText;
                        if (textValue.toUpperCase().indexOf(filter) > -1) {
                            shouldDisplay = true;
                            break;
                        }
                    }
                }

                row.style.display = shouldDisplay ? '' : 'none';
            }
        }

        const searchButton = document.getElementById('searchButton');
        const clearButton = document.getElementById('clearButton');
        const searchInput = document.getElementById('search');
        const tableBody = document.getElementById('tableBody');
        const originalTableContent = tableBody.innerHTML;

        searchButton.addEventListener('click', () => {
            const searchValue = searchInput.value.trim().toLowerCase();
            const rows = tableBody.querySelectorAll('tr');

            rows.forEach(row => {
                const columns = row.getElementsByTagName('td');
                let match = false;

                for (let i = 0; i < columns.length; i++) {
                    const columnText = columns[i].innerText.trim().toLowerCase();
                    if (columnText.includes(searchValue)) {
                        match = true;
                        break;
                    }
                }

                row.style.display = match ? '' : 'none';
            });
        });

        clearButton.addEventListener('click', () => {
            searchInput.value = '';
            const rows = tableBody.querySelectorAll('tr');
            rows.forEach(row => {
                row.style.display = '';
            });
        });

    </script>
</body>

</html>
