<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangModel extends Model
{
    use HasFactory;

    protected $table = 'm_barang'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'barang_id'; // Primary key dari tabel yang digunakan
    protected $fillable = [
        'kategori_id',
        'barang_kode',
        'barang_nama',
        'harga_beli',
        'harga_jual',
    ]; // Kolom-kolom yang dapat diisi secara massal
}
