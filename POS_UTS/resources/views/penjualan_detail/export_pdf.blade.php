<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Laporan Data Detail Penjualan</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            margin: 6px 20px 5px 20px;
            line-height: 1.1; 
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td, th {
            padding: 6px 4px; 
            text-align: left; 
        }
        th {
            font-weight: bold; 
        }
        .d-block {
            display: block;
        }
        img.image {
            width: auto;
            height: 80px;
            max-width: 150px;
            max-height: 150px;
            vertical-align: middle; 
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .p-1 {
            padding: 5px 1px; 
        }
        .font-10 {
            font-size: 10pt;
        }
        .font-11 {
            font-size: 11pt;
        }
        .font-12 {
            font-size: 12pt;
        }
        .font-13 {
            font-size: 13pt;
        }
        .font-bold {
            font-weight: bold;
        }
        .mb-1 {
            margin-bottom: 0.5em;
        }
        .border-bottom-header {
            border-bottom: 1px solid black; 
            padding-bottom: 8px; 
            margin-bottom: 10px; 
        }
        .border-all, .border-all th, .border-all td {
            border: 1px solid black; 
        }
    </style>
</head>
<body>
    <table class="border-bottom-header">
        <tr>
            <td width="15%" class="text-center">
                <img src="{{ asset('polinema-bw.png') }}" alt="Polinema Logo" class="image">
            </td>
            <td width="85%">
                <span class="text-center d-block font-11 font-bold mb-1">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET, DAN TEKNOLOGI</span>
                <span class="text-center d-block font-13 font-bold mb-1">POLITEKNIK NEGERI MALANG</span>
                <span class="text-center d-block font-10">Jl. Soekarno-Hatta No. 9 Malang 65141</span>
                <span class="text-center d-block font-10">Telepon (0341) 404424 Pes. 101-105, 0341-404420, Fax. (0341) 404420</span>
                <span class="text-center d-block font-10">Laman: www.polinema.ac.id</span>
            </td>
        </tr>
    </table>
    <h3 class="text-center">LAPORAN DATA DETAIL PENJUALAN</h3>
    <table class="border-all">
        <thead>
            <tr>
                <th class="text-center">NO</th>
                <th>ID Penjualan</th>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @php
                $grandTotal = 0;
            @endphp
           @foreach($barang as $b)
                @php
                    $total = $b->harga * $b->jumlah;
                    $grandTotal += $total;
                @endphp
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td> 
                    <td>{{ $b->penjualan_id }}</td>
                    <td>{{ $b->barang->barang_nama ?? '-' }}</td> <!-- Nama Barang dari relasi barang -->
                    <td>{{ number_format($b->harga, 0, ',', '.') }}</td>
                    <td>{{ $b->jumlah }}</td>
                    <td>{{ number_format($b->harga * $b->jumlah, 0, ',', '.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="5" class="text-right font-bold" ><span style="margin-right: 15px;">Total Penjualan</span></td>
                <td class="font-bold">{{ number_format($grandTotal, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>