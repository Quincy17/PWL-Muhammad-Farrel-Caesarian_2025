<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokModel extends Model
{
    use HasFactory;

    protected $table = 'm_stok'; // Nama tabel yang digunakan oleh model ini
    protected $primaryKey = 'stok_id'; // Primary key dari tabel yang digunakan

    protected $fillable = [
        'barang_id',
        'supplier_id',
        'user_id',
        'stok_tanggal',
        'stok_jumlah',
    ]; // Kolom-kolom yang dapat diisi secara massal
}
