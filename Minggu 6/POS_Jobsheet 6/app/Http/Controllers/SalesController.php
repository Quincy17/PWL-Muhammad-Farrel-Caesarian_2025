<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
{
    $transaksi = [
        [
            'id' => 1,
            'produk' => 'Susu Formula',
            'kategori' => 'Baby Kid',
            'harga' => 50000,
            'jumlah' => 2,
            'total' => 100000
        ],
        [
            'id' => 2,
            'produk' => 'Sabun Mandi',
            'kategori' => 'Beauty Health',
            'harga' => 15000,
            'jumlah' => 3,
            'total' => 45000
        ],
        [
            'id' => 3,
            'produk' => 'Minuman Bersoda',
            'kategori' => 'Food Beverage',
            'harga' => 10000,
            'jumlah' => 5,
            'total' => 50000
        ],
        [
            'id' => 4,
            'produk' => 'Detergen Cair',
            'kategori' => 'Home Care',
            'harga' => 25000,
            'jumlah' => 2,
            'total' => 50000
        ],
    ];

    return view('sales', compact('transaksi'));
}

}