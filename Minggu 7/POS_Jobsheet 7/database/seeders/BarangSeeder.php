<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => Str::random(10), 'barang_nama' => 'Sate Ayam', 'harga_beli' => 10000, 'harga_jual' => 13000],
            ['barang_id' => 2, 'kategori_id' => 2, 'barang_kode' => Str::random(10), 'barang_nama' => 'Coca Cola', 'harga_beli' => 3000, 'harga_jual' => 8000],
            ['barang_id' => 3, 'kategori_id' => 3, 'barang_kode' => Str::random(10), 'barang_nama' => 'Beng Beng', 'harga_beli' => 1000, 'harga_jual' => 2000],
            ['barang_id' => 4, 'kategori_id' => 4, 'barang_kode' => Str::random(10), 'barang_nama' => 'Risol Mayo', 'harga_beli' => 1000, 'harga_jual' => 2000],
            ['barang_id' => 5, 'kategori_id' => 5, 'barang_kode' => Str::random(10), 'barang_nama' => 'Putri Salju', 'harga_beli' => 25000, 'harga_jual' => 50000],
            ['barang_id' => 6, 'kategori_id' => 1, 'barang_kode' => Str::random(10), 'barang_nama' => 'Pecel', 'harga_beli' => 8000, 'harga_jual' => 12000],
            ['barang_id' => 7, 'kategori_id' => 2, 'barang_kode' => Str::random(10), 'barang_nama' => 'Jus Alpukat', 'harga_beli' => 5000, 'harga_jual' => 10000],
            ['barang_id' => 8, 'kategori_id' => 3, 'barang_kode' => Str::random(10), 'barang_nama' => 'Oreo', 'harga_beli' => 1000, 'harga_jual' => 2000],
            ['barang_id' => 9, 'kategori_id' => 4, 'barang_kode' => Str::random(10), 'barang_nama' => 'Pastel', 'harga_beli' => 1000, 'harga_jual' => 2000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => Str::random(10), 'barang_nama' => 'Nastar', 'harga_beli' => 25000, 'harga_jual' => 60000],
        ];

        DB::table('m_barang')->insert($data);
    }
}
