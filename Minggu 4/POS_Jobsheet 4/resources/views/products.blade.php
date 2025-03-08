<!DOCTYPE html>
<html>
<head>
    <title>Daftar Produk</title>
</head>
<body>
    <h1>Daftar Produk</h1>
    <h2>Kategori: {{ ucfirst(str_replace('-', ' ', $category)) }}</h2>
    <p>Menampilkan produk dari kategori {{ $category }}</p>
</body>
</html>
