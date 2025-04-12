<!DOCTYPE html>
 <html>
 <head>
     <title>Data Penjualan</title>
 </head>
 <body>
     <h1>Data User</h1>
     <table border="1" cellpadding="2" cellspacing="0">
         <tr>
             <th>ID</th>
             <th>ID Penjualan</th>
             <th>ID Barang</th>
             <th>Harga</th>
             <th>Jumlah</th>
         </tr>
         @foreach ($data as $d)
         <tr>
             <td>{{ $d->detail_id }}</td>
             <td>{{ $d->penjualan_id }}</td>
             <td>{{ $d->barang_id }}</td>
             <td>{{ $d->harga }}</td>
             <td>{{ $d->jumlah }}</td>
         </tr>
         @endforeach
     </table>
 </body>
 </html>