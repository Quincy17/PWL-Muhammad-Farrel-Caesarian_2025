<head>
    <title>Halaman Transaksi POS</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: auto; /* Membuat tabel menyesuaikan kontennya */
        }
        th, td {
            border: 1px solid black;
            padding: 10px;
            text-align: left;
            white-space: nowrap; /* Mencegah teks terpotong */
            max-width: 200px; /* Batas lebar maksimum */
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Halaman Transaksi POS</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produk</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($transaksi as $item)
            <tr>
                <td>{{ $item['id'] }}</td>
                <td>{{ $item['produk'] }}</td>
                <td>{{ $item['kategori'] }}</td>
                <td>Rp{{ number_format($item['harga'], 0, ',', '.') }}</td>
                <td>{{ $item['jumlah'] }}</td>
                <td>Rp{{ number_format($item['total'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
